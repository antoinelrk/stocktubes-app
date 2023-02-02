@extends('layouts.app')
@section('title', "Home")

@section('content')
<section class="content home">
    <h1>Bienvenue {{ auth()->user()->name }}</h1>
</section>
@endsection