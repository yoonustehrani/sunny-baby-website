<?php

namespace App\Livewire\Affiliate;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.auth-affiliate')]
class Login extends Component
{
    #[Validate('required|string|regex:/09[0-9]{9}/')]
    public string $phone_number = '';

    #[Validate('required|string|min:8|max:50')]
    public string $password = '';

    public function login()
    {
        $this->validate();

        $user = User::wherePhoneNumber($this->phone_number)->first();
        if (! $user || ! Hash::check($this->password, $user->password)) {
            $this->addError('password', 'شماره تلفن و رمز عبور همخوانی ندارد');
            return;
        }
        Auth::login($user);
        $this->redirectAction(Dashboard::class, navigate: true);
    }

    public function render()
    {
        return view('livewire.affiliate.login')->title(__("Affiliate Panel") . " | " . __('Login'));
    }
}
