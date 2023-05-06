@extends('layouts.app')
@section('title', "Administration")

@section('content')
<section class="content form admin">
    <h1>Add a new user</h1>
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
        <div class="form-group row">
            <button class="btn-submit" type="submit">Créer</button>
        </div>
    </form>

    <h1>Export/Import data</h1>
    <div class="admin-section">
        <p>Exporter les données au format JSON:
            <a href="{{ route('tubes.export') }}" class="btn-submit">Export Tubes</a>
            <a href="{{ route('smc.export') }}" class="btn-submit">Export SMC</a>
        </p>
    </div>

    <div class="admin-section">
        <p>Importer les données au format JSON. Attention, risque d'écrasement de la base de donnée.</p>
        <form action="" method="POST">
            <button type="submit" disabled>Importer</button>
        </form>
    </div>
</section>
@endsection