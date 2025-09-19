<?php

namespace App\Livewire;

use App\Models\AuthCode;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session as LaravelSession;
use Livewire\Attributes\Session;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LoginModal extends Component
{
    #[Session]
    #[Validate('required|digits:11|regex:/09[0-9]{9}/')]
    public string $phone_number = '';

    #[Validate('required|string|numeric|regex:/[0-9]{4}/')]
    public ?string $code = null;

    #[Session]
    public bool $final = false;

    public function submit()
    {
        if (! $this->final && ! $this->code && $this->validateOnly('phone_number')) {
            $this->final = true;
            $authCodeModel = $this->getFreshAuthCode();
            return;
        }
        $this->validate();
        $authCodeModel = AuthCode::wherePhoneNumber($this->phone_number)->first();
        if (! $authCodeModel) {
            $this->final = false;
            return;
        }
        if ($authCodeModel->is_expired) {
            $this->final = false;
            $this->code = '';
            $this->addError('code', __('OTP code is expired. Ask for a new one and try again.'));
            return;
        }
        if ($authCodeModel->code != $this->code) {
            $this->addError('code', __('Invalid code'));
            return;
        }
        $user = User::firstOrCreate(
            ['phone_number' => $this->phone_number]
        );
        $this->reset();
        Auth::login($user);
        LaravelSession::regenerate();
        $this->dispatch('user-logged-in');
    }

    protected function getFreshAuthCode(): AuthCode
    {
        $code = generate_otp_code();
        if (config('services.sms.enabled')) {
            send_otp($this->phone_number, $code);
        } else {
            Log::alert('code: ' . $code);
        }
        return AuthCode::query()->updateOrCreate(
            ['phone_number' => $this->phone_number],
            ['code' => $code, 'expires_at' => now()->addMinutes(2)]
        );
    }

    public function resendCode()
    {
        $this->getFreshAuthCode();
    }

    public function render()
    {
        return view('livewire.login-modal');
    }
}
