<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function logOut()
    {
        Auth::logout();
        Session::flush();
        return redirect(route('home'));
    }
}
