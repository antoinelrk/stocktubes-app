@extends('layouts.app')
@section('title', "Tube - " . $tube->reference)

@section('content')
<section class="content tubes show">

    <div class="show-head">
        <div class="tube-title">
            <h3 class="title">Reference</h3>
            <p class="reference">{{ $tube->reference }}</p>
        </div>

        <div class="tube-data">
            <ul>
                <li>
                    <span>Quantity</span>&nbsp;
                    <i class="@if ($tube->quantity <= $tube->critical) critical @elseif ($tube->quantity <= $tube->warning) warning @endif">
                        {{ $tube->quantity }}
                    </i>
                </li>
                <li>
                    <span>Used</span>&nbsp;
                    {{ $tube->used }}
                </li>
                <li>
                    <span>Unused</span>&nbsp;
                    {{ $tube->unused }}
                </li>
            </ul>
        </div>
    </div>

    <div class="tube-datasheet">
        <iframe src="/storage/datasheets/tubes/{{ $tube->datasheet }}"></iframe>
    </div>

    <div class="tube-control">
        <a class="btn edit" href="{{ route('tubes.updateTubeForm', $tube->slug) }}">Editer</a>
        <a class="btn delete" href="{{ route('tubes.deleteTubeForm', $tube->slug) }}">Supprimer</a>
    </div>
</section>
@endsection