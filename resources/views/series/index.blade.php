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
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>
    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $serie['name'] }}

                <span class="d-flex">
                    <a href="series/{{ $serie['id'] }}/seasons" class="btn btn-info btn-sm mr-1">
                        <i class="fas fa-external-link-alt"></i>
                    </a>

                    <form action="/series/destroy/{{ $serie['id'] }}" method="post"
                        onsubmit="return confirm('Tem ctz, parça?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                </span>
            </li>
        @endforeach
    </ul>

@endsection
