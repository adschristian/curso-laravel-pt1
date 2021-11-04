@extends('layout')

@section('header')
    Adicionar série
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="/series/store">
        @csrf
        <div class="row">
            <div class="col col-8">
                <label class="" for="name">Nome da série: </label>
                <input class="form-control" type="text" name="name" id="name">
            </div>
            <div class="col col-2">
                <label class="" for="number_of_seasons">Nº de temporadas: </label>
                <input class="form-control" type="number" name="number_of_seasons" id="number_of_seasons">
            </div>
            <div class="col col-2">
                <label class="" for="number_of_episodes">Episódios/temporada: </label>
                <input class="form-control" type="number" name="number_of_episodes" id="number_of_episodes">
            </div>
        </div>
        <button class="btn btn-primary mt-2">Adicionar</button>
    </form>

@endsection
