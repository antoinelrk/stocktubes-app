@extends('layouts.app')
@section('title', "Add semi-conductors")

@section('content')
<section class="content tubes form">
    <form action="{{ route('smc.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="text" for="reference">
                <span>Référence</span>
            </label>
            <input type="text" name="reference" placeholder="Référence du smc">
        </div>
        <div class="form-group">
            <label class="text" for="used">
                <span>Occasion</span>
            </label>
            <input type="number" name="used" value="0" placeholder="Nombre de smc d'occasions">
        </div>
        <div class="form-group">
            <label class="text" for="unused">
                <span>Neuf</span>
            </label>
            <input type="number" name="unused" value="0" placeholder="Nombre de smc neufs">
        </div>
        <div class="form-group">
            <label class="text" for="warning">
                <span>Niveau d'attention</span>
            </label>
            <input type="number" name="warning" placeholder="Niveau de quantité d'attention">
        </div>
        <div class="form-group">
            <label class="text" for="critical">
                <span>Niveau critique</span>
            </label>
            <input type="number" name="critical" placeholder="Niveau de quantité critique">
        </div>
        <div class="form-group file-group">
            <input  class="file" type="file" name="datasheet" class="hidded">
        </div>
        <div class="form-group row">
            <button type="submit" class="btn-submit">
                Create
            </button>
        </div>
    </form>
</section>
@endsection