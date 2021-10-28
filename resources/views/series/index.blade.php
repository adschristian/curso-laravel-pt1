@extends('layout')

@section('header')
    Séries
@endsection

@section('content')
    @if (!empty($message))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    <a href="/series/create" class="btn btn-dark mb-2">Adicionar</a>
    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item">
                {{ $serie['name'] }}
                <form action="/series/destroy/{{ $serie['id'] }}" method="post" onsubmit="return confirm('Tem ctz, parça?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        Excluir
                    </button>
                </form>
            </li>
        @endforeach
    </ul>

@endsection
