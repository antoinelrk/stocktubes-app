@extends('layouts.app')
@section('title', "Semi-Conducteur - " . $smc->reference)

@section('content')
<section class="content tubes show">
    <div class="show-head">
        <div class="tube-title">
            <h3 class="title">Reference</h3>
            <p class="reference">{{ $smc->reference }}</p>
        </div>

        <div class="tube-data">
            <ul>
                <li>
                    <span>Added by</span>&nbsp;
                    {{ $smc->user->name }}
                </li>
                <li>
                    <span>Created at</span>&nbsp;
                    {{ $smc->created_at->format('d/m/Y') }}
                </li>
                <li>
                    <span>Updated at</span>&nbsp;
                    {{ $smc->updated_at->format('d/m/Y') }}
                </li>
            </ul>
            <ul>
                <li>
                    <span>Quantity</span>&nbsp;
                    <i class="@if ($smc->quantity <= $smc->critical) critical @elseif ($smc->quantity <= $smc->warning) warning @endif">
                        {{ $smc->quantity }}
                    </i>
                </li>
                <li>
                    <span>Used</span>&nbsp;
                    {{ $smc->used }}
                </li>
                <li>
                    <span>Unused</span>&nbsp;
                    {{ $smc->unused }}
                </li>
            </ul>
        </div>
    </div>

    <div class="tube-control">
        <a class="btn edit" href="{{ route('smc.updateSmcForm', $smc->slug) }}">Editer</a>
        <a
            class="btn js-delete-tube danger @if($smc->datasheet === null) disabled @endif"
            data-payload="/smc/datasheet/remove/"
            data-tube="{{ $smc }}"
            data-message="Souhaitez-vous supprimer le datasheet du semi-conduteur {{ $smc->reference }} ?"
            >
            Supprimer le datasheet
        </a>
        <a
            class="btn delete js-delete-tube danger"
            data-payload="/smc/delete/"
            data-tube="{{ $smc }}"
            data-message="Souhaitez-vous vraiment supprimer le semi-conduteur {{ $smc->reference }} ?"
            >
            <figure>
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 448 512">
                    <path d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path>
                </svg>
            </figure>
        </a>
    </div>

    <div class="tube-datasheet">
        @if ($smc->datasheet)
            <iframe src="/storage/datasheets/smc/{{ $smc->datasheet }}"></iframe>
        @else
        <p>Aucun datasheet disponible</p>
        @endif
    </div>


</section>
@endsection