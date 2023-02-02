@extends('layouts.app')
@section('title', "Administration")

@section('content')
<section class="content form">
    <form action="{{ route('users.create') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="text" for="name"><span>Nom d'utilisateur</span></label>
            <input type="text" name="name" id="name">
        </div>

        <div class="form-group">
            <label class="text" for="email"><span>Email</span></label>
            <input type="email" name="email" id="email">
        </div>

        <div class="form-group">
            <label class="text" for="password"><span>Mot de passe</span></label>
            <input type="password" name="password" id="password">
        </div>

        <div class="form-group">
            <label class="text" for="password_confirmation"><span>Confirmation du mot de passe</span></label>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div>

        <button type="submit">Créer</button>
    </form>

    <div class="admin-section">
        <p>Exporter les données au format JSON</p>
        <button>Export database</button>
    </div>

    <div class="admin-section">
        <p>Importer les données au format JSON. Attention, risque d'écrasement de la base de donnée.</p>
        <form action="" method="POST">
            <button type="submit" disabled>Importer</button>
        </form>
    </div>
</section>
@endsection