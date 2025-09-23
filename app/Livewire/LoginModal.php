<?php

namespace App\Livewire;

use App\Models\AuthCode;
use App\Models\User;
use App\Traits\LoginMethods;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session as LaravelSession;
use Livewire\Attributes\Session;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LoginModal extends Component
{
    use LoginMethods;
    
    public function render()
    {
        return view('livewire.login-modal');
    }
}
