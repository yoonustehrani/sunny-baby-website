<?php

namespace App\Services\Payment;

use App\Enums\TransactionStatus;
use App\Models\Transaction;
use App\Models\User;
use App\Traits\ServiceGeneralMethods;
use Illuminate\Database\Eloquent\Model;

abstract class PaymentGateway
{
    use ServiceGeneralMethods;

    abstract public function isActive(): bool;
    abstract public function getTransactionUrl(): string;
    abstract public function validateTransaction(): bool;

    public function __construct(public Transaction $transaction)
    {
        
    }

    public static function createTransaction(int $amount, User $user, Model $payable)
    {
        $transaction = new Transaction([
            'method' => ZarinpalGateway::class,
            'amount' => $amount,
            'status' => TransactionStatus::PENDING
        ]);
        $transaction->payable()->associate($payable);
        $transaction = $user->transactions()->save($transaction);
        $transaction->refresh();
        return new static($transaction);
    }
}