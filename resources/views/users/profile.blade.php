@extends('layouts.app')
@section('title', __("pages.profile", ['name' => $user->name]))

@section('content')
<section class="content profile">
    <section class="presentation">
        <div class="circle-picture">
            <img src="{{ $user->profile_picture ?? '/storage/users/avatars/default.png' }}" alt="Photo de {{ $user->name }}">
        </div>
        <h1 class="user-name">{{ ucfirst($user->name) }}</h1>
        <span>Inscrit le {{ $user->created_at->format('d/m/Y') }}</span>
    </section>
    <div class="control">
        <button class="user-control">{{ __('ui.edit') }}</button>
        <button class="user-control danger disabled" disabled>{{ __('ui.delete') }}</button>
    </div>
</section>
@endsection