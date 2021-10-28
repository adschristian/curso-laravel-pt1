@extends('layout')

@section('header')
Adicionar série
@endsection

@section('content')

<form method="post" action="/series/store">
    @csrf
    <div class="form-group">
        <label class="" for="name">Nome da série: </label>
        <input class="form-control" type="text" name="name" id="name">
    </div>
    <button class="btn btn-primary mt-2">Adicionar</button>
</form>

@endsection