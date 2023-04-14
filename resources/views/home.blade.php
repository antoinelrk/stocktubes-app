@extends('layouts.app')
@section('title', "Home")

@section('content')
<section class="content home">
    <h1>{{ __('lines.welcome', ['name' => ucfirst(auth()->user()->name)]) }}</h1>
</section>
@endsection