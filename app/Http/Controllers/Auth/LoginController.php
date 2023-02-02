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
            return redirect(route('home'))->with(['success' => 'Vous êtes maintenant connecté']);
        }
        return redirect(route('home'))->with(['errors' => 'Impossible de vous déconnecter, veuillez contacter un administrateur']);
    }

    public function logout () {  
        Auth::logout();
        return redirect(route('login'))->with(['success' => 'Vous êtes maintenant déconnecté']);
    }
}
