@extends('layouts.app')
@section('title', "Home")

@section('content')
<section class="content home">
    <h1>{{ __('lines.welcome', ['name' => ucfirst(auth()->user()->name)]) }}</h1>
    <div class="patchnote">
        <ul>
            <h2>Dernières fonctionnalité</h2>
            <li class="no-element">Aucune</li>
        </ul>
        <ul>
            <h2>Fonctionnalité à venir</h2>
            <li>Changer son mot de passe</li>
            <li>Changer sa photo de profil</li>
        </ul>
    </div>
</section>
@endsection