<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RequestLogin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm () {
        return view('auth.login');
    }

    public function login (RequestLogin $request) {
        $credentials = [
            'name' => $request->name,
            'password' => $request->password
        ];
        if (Auth::attempt($credentials)) {
            return redirect(route('home'));
        }
        return redirect(route('home'));
    }

    public function logout () {  
        Auth::logout();
        return redirect(route('home'));
    }
}
