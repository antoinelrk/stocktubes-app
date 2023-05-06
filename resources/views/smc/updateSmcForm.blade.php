@extends('layouts.app')
@section('title', "Edit semi-conductor $smc->reference")

@section('content')
<section class="content form">
    <form action="{{ route('smc.update', $smc->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="text" for="reference">
                <span>Référence</span>
            </label>
            <input type="text" name="reference" placeholder="Référence du tube" value="{{ $smc->reference }}">
        </div>
        <div class="form-group">
            <label class="text" for="used">
                <span>Occasion</span>
            </label>
            <input type="number" name="used" placeholder="Nombre de semi-conducteur d'occasions" value="{{ $smc->used }}">
        </div>
        <div class="form-group">
            <label class="text" for="unused">
                <span>Neuf</span>
            </label>
            <input type="number" name="unused" placeholder="Nombre de semi-conducteur neufs" value="{{ $smc->unused }}">
        </div>
        <div class="form-group">
            <label class="text" for="warning">
                <span>Niveau d'attention</span>
            </label>
            <input type="number" name="warning" placeholder="Niveau de quantité d'attention" value="{{ $smc->warning }}">
        </div>
        <div class="form-group">
            <label class="text" for="critical">
                <span>Niveau critique</span>
            </label>
            <input type="number" name="critical" placeholder="Niveau de quantité critique" value="{{ $smc->critical }}">
        </div>
        <div class="form-group file-group">
            <input  class="file" type="file" name="datasheet" class="hidded">
        </div>
        <div class="form-group row">
            <button type="submit" class="btn-submit">
                Update
            </button>
        </div>
    </form>
</section>
@endsection