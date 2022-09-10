<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RequestRegister;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm () {
        return view('auth.register');
    }

    public function register (RequestRegister $request) {
        try {
            $user = User::create([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'profil_picture' => "image",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            Auth::login($user);
            return redirect(route('home'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
        return redirect(back());
    }
}
