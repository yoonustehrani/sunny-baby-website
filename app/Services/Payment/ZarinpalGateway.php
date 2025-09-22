<?php

namespace App\Services\Payment;

use App\Enums\TransactionStatus;
use App\Models\Transaction;
use App\Models\User;
use ZarinPal\Sdk\Options;
use ZarinPal\Sdk\ZarinPal;
use ZarinPal\Sdk\ClientBuilder;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Illuminate\Support\Facades\DB;
use ZarinPal\Sdk\Endpoint\PaymentGateway\RequestTypes\RequestRequest;
use ZarinPal\Sdk\Endpoint\PaymentGateway\RequestTypes\VerifyRequest;
use ZarinPal\Sdk\HttpClient\Exception\ResponseException;

class ZarinpalGateway extends PaymentGateway
{
    public string $name = 'زرین پال';
    
    public function getPaymentLib()
    {
        $clientBuilder = new ClientBuilder();
        $clientBuilder->addPlugin(new HeaderDefaultsPlugin([
            'Accept' => 'application/json',
        ]));

        $options = new Options([
            'client_builder' => $clientBuilder,
            'merchant_id'    => env('ZARINPAL_MERCHANT_ID'),
            // 'access_token'   => 'your-access-token-here',
            'sandbox'        => true,
        ]);

        return new ZarinPal($options);
    }

    public function isActive(): bool
    {
        return true;
    }

    public function getTransactionUrl(): string
    {
        $user = $this->transaction->user()->first();
        $paymentGateway = $this->getPaymentLib()->paymentGateway();
        $request = new RequestRequest();
        $request->description = 'test';
        $request->amount = $this->transaction->amount * 10;
        $request->currency = 'IRR';
        $request->mobile = $user->phone_number;
        if ($user->email) {
            $request->email = $user->email;
        }
        $request->callback_url = route('transactions.validate', ['transaction' => $this->transaction->id, 'gateway' => 'zp']);
        try {
            $response = $paymentGateway->request($request);
            $this->transaction->addToMeta('zarinpal', [
                'authority' => $response->authority
            ]);
            $this->transaction->save();
            $url = $paymentGateway->getRedirectUrl($response->authority); // create full url Payment
            return $url;
        } catch (ResponseException $e) {
            throw $e;
            // var_dump();
        } catch (\Exception $e) {
            throw $e;
            // echo 'Payment Error: ' . $e->getMessage();
        }
    }

    public function validateTransaction(): bool
    {
        $authority = $this->transaction->meta->zarinpal->authority;
        $zarinpal = $this->getPaymentLib();
        $authority = filter_input(INPUT_GET, 'Authority');
        $status = filter_input(INPUT_GET, 'Status');

        if ($status === 'OK') {
            $amount = $this->transaction->amount * 10;
            if ($amount) {
                $verifyRequest = new VerifyRequest();
                $verifyRequest->authority = $authority;
                $verifyRequest->amount = $amount;

                try {
                    $response = $zarinpal->paymentGateway()->verify($verifyRequest);
                    DB::beginTransaction();
                    if ($response->code === 100) {
                        $this->transaction->addToMeta('trx', [
                            'Reference ID' => $response->ref_id,
                            'Card PAN' => $response->card_pan,
                            'Fee' => $response->fee
                        ]);
                        $this->transaction->status = TransactionStatus::PAID;
                        if (! $this->transaction->paid_at) {
                            $this->transaction->payable->increment('total_paid', $this->transaction->amount);
                            $this->transaction->paid_at = now();
                        }
                        $this->transaction->save();
                        DB::commit();
                        return true;
                    } else if ($response->code === 101) {
                        $this->transaction->update([
                            'status' => TransactionStatus::PAID
                        ]);
                        DB::commit();
                        return true;
                    } else {
                        $reason = "Transaction failed with code: " . $response->code;
                    }
                    DB::commit();
                } catch (ResponseException $e) {
                    DB::rollBack();
                    $reason = 'Payment Verification Failed: ' . $e->getErrorDetails()['errors']['message'];
                } catch (\Exception $e) {
                    DB::rollBack();
                    $reason = 'Payment Error: ' . $e->getMessage();
                }
            } else {
                $reason = 'No Matching Transaction Found For This Authority Code.';
            }
        } else {
            $reason = 'Transaction was cancelled or failed.';
        }
        $this->transaction->addToMeta('reason', $reason);
        $this->transaction->status = TransactionStatus::ERROR;
        $this->transaction->save();
        return false;
    }
}