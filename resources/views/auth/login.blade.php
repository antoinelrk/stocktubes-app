@extends('layouts.app')
@section('title', "Home")

@section('content')
<section class="content auth form">
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="text" for="name">
                <span>Nom d'utilisateur</span>
            </label>
            <input type="text" name="name" placeholder="Votre nom d'utilisateur">
        </div>
        <div class="form-group">
            <label class="text" for="name">
                <span>Mot de passe</span>
            </label>
            <input type="password" name="password" placeholder="Votre mot de passe">
        </div>
        <div class="form-group row">
            <button type="submit" class="btn-submit">
                Login
            </button>
        </div>
    </form>
</section>
@endsection