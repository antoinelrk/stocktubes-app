@extends('layouts.app')
@section('title', "Profile de " . $user->name)

@section('content')
<section class="content profile">
    Profil de {{ $user->name }}
</section>
@endsection