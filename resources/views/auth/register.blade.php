@extends('layouts.app')
@section('title', "Register")

@section('content')
<section class="content auth form">
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="text" for="name">
                <span>Nom d'utilisateur</span>
            </label>
            <input type="text" name="name" placeholder="Votre nom d'utilisateur">
        </div>

        <div class="form-group">
            <label class="text" for="name">
                <span>Email</span>
            </label>
            <input type="email" name="email" placeholder="Votre adresse e-mail">
        </div>
        <div class="form-group">
            <label class="text" for="name">
                <span>Mot de passe</span>
            </label>
            <input type="password" name="password" placeholder="Votre mot de passe">
        </div>
        <div class="form-group">
            <label class="text" for="name">
                <span>Confirmation du mot de passe</span>
            </label>
            <input type="password" name="password_confirmation" placeholder="Confirmer votre mot de passe">
        </div>
        <div class="form-group row">
            <button type="submit" class="btn-submit">
                Register
            </button>
        </div>
    </form>
</section>
@endsection