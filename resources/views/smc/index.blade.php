@extends('layouts.app')
@section('title', "Semi-Conductors")

@section('content')
<section class="content tubes">
    <div class="content-head">

        <h2 class="js-title-tubes" data-tubes="{{ $smc->values() }}">List of Semi-Conductors ({{ $smc->total() }})</h2>

        <div class="control">
            <div class="search-bar">
                <div class="search-icon">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 48 48">
                            <path d="M31 28h-1.59l-.55-.55C30.82 25.18 32 22.23 32 19c0-7.18-5.82-13-13-13S6 11.82 6 19s5.82 13 13 13c3.23 0 6.18-1.18 8.45-3.13l.55.55V31l10 9.98L40.98 38 31 28zm-12 0c-4.97 0-9-4.03-9-9s4.03-9 9-9 9 4.03 9 9-4.03 9-9 9z"></path>
                        </svg>
                    </figure>
                </div>
                <label for="search-input">
                    <input type="text" id="search-input" placeholder="REFERENCE">
                </label>
            </div>

            <a class="btn-create-tube" href="{{ route('smc.addSmcForm') }}">
                <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"></path>
                    </svg>
                </figure>
                <span>Add SMC</span>
            </a>
        </div>
    </div>

    <div class="table">
        <div class="head-table">
            <div class="btn-regroup">
                <button class="js-mode-show active" data-filter="all">All</button>
                <button class="js-mode-show" data-filter="warning">Warning</button>
                <button class="js-mode-show" data-filter="critical">Critical</button>
            </div>
        </div>

        <table class="body-table" id="tubesTable">
            <tr class="title">
                <td class="reference">Reference</td>
                <td class="number">Quantity</td>
                <td class="number">Used</td>
                <td class="number">Unused</td>
                <td class="action">Action</td>
            </tr>

            @foreach ($smc as $semi_conductor)
            <tr class="line" id="line">
                <td class="reference warning">
                    <a href="{{ route('smc.show', $semi_conductor->slug) }}">{{ $semi_conductor->reference }}</a>
                </td>
                <td class="number @if ($semi_conductor->quantity <= $semi_conductor->critical) critical @elseif ($semi_conductor->quantity <= $semi_conductor->warning) warning @endif">
                    {{ ($semi_conductor->quantity) }}
                </td>
                <td class="number">
                    {{ $semi_conductor->used === null ? "Non défini" : $semi_conductor->used }}
                </td>
                <td class="number">
                    {{ $semi_conductor->unused === null ? "Non défini" : $semi_conductor->unused }}
                </td>
                <td class="action">
                    <a href="{{ route('smc.updateSmcForm', $semi_conductor->slug) }}">
                        <figure>
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 512 512">
                                <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                            </svg>
                        </figure>
                    </a>
                    <a class=" @if ($semi_conductor->datasheet === null) lock @endif" target="_blank" href="/storage/datasheets/smc/{{ $semi_conductor->datasheet }}">
                        <figure>
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 121 113">
                                <g fill-rule="evenodd" stroke-linejoin="round">
                                    <path id="document-file-pdf" d="M79.167 95.833v8.344a8.314 8.314 0 0 1-8.323 8.323H8.323C3.712 112.5 0 108.755 0 104.136V8.364C0 3.743 3.747 0 8.369 0H50v25.008c0 4.631 3.742 8.325 8.358 8.325h20.809v8.334H41.695c-6.919 0-12.528 5.592-12.528 12.495v29.176c0 6.901 5.566 12.495 12.528 12.495h37.472zM54.167 0v24.988c0 2.308 1.879 4.179 4.128 4.179h20.872L54.167 0zM41.644 45.833c-4.59 0-8.311 3.751-8.311 8.3v29.234c0 4.584 3.76 8.3 8.311 8.3h70.879c4.59 0 8.31-3.751 8.31-8.3V54.133c0-4.584-3.759-8.3-8.31-8.3H41.644zm54.189 20.834v-8.334H112.5v-4.166H91.667v29.166h4.166v-12.5h12.5v-4.166h-12.5zM41.667 62.5v20.833h4.166v-12.5h8.313c4.614 0 8.354-3.699 8.354-8.333 0-4.602-3.725-8.333-8.354-8.333H41.667V62.5zm4.166-4.167v8.334h8.338a4.154 4.154 0 0 0 4.162-4.167 4.152 4.152 0 0 0-4.162-4.167h-8.338zm20.834-4.166v29.166h12.479a8.325 8.325 0 0 0 8.354-8.358v-12.45a8.346 8.346 0 0 0-8.354-8.358H66.667zm4.166 4.166v20.834h8.338a4.153 4.153 0 0 0 4.162-4.166V62.499a4.152 4.152 0 0 0-4.162-4.166h-8.338z"></path>
                                </g>
                            </svg>
                        </figure>
                    </a>
                    <a class="btn-remove-danger js-delete-tube"
                       data-message="Souhaitez-vous vraiment supprimer le semi-conduteur {{ $semi_conductor->reference }} ?"
                       data-payload="/smc/delete/{{ $semi_conductor->slug }}"
                       data-tube="{{ json_encode(json_encode($semi_conductor)) }}"
                    >
                        <figure>
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 448 512">
                                <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                            </svg>
                        </figure>
                    </a>   
                </td>
            </tr>
            @endforeach
        </table>
        {{-- <div class="paginator">
            <nav class="pagination">
                <a class="first" href="{{ $tubes->url(1) }}">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24">
                            <path d="M18.41 16.59L13.82 12l4.59-4.59L17 6l-6 6 6 6 1.41-1.41zM6 6h2v12H6V6z"></path>
                        </svg>
                    </figure>
                </a>
                <a class="prev" href="{{ $tubes->previousPageUrl() }}">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24">
                            <path d="M14.2 6l-6 6 6 6 1.41-1.41L11.03 12l4.58-4.59L14.2 6z"></path>
                        </svg>
                    </figure>
                </a>
                <a class="next" href="{{ $tubes->nextPageUrl() }}">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24">
                            <path d="M10.02 6L8.61 7.41 13.19 12l-4.58 4.59L10.02 18l6-6-6-6z"></path>
                        </svg>
                    </figure>
                </a>
                <a class="last">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24">
                            <path d="M5.59 7.41L10.18 12l-4.59 4.59L7 18l6-6-6-6-1.41 1.41zM16 6h2v12h-2V6z"></path>
                        </svg>
                    </figure>
                </a>
            </nav>
        </div> --}}
    </div>
</section>
@endsection