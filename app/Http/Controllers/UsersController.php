<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\CreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', [
            'only' => 'create'
        ]);
    }

    public function profile () {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    public function create(CreateRequest $request)
    {
        $user = User::create(array_merge($request->validated(), ['password' => Hash::make($request->password)]));
        return redirect(route('dashboard'))->with(['success', "L'utilisateur $user->name a bien été ajouté"]);
    }
}
