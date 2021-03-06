@extends('layout')

@section('header')
    Episódios
@endsection

@section('content')

    @includeWhen(!empty($message), 'message', ['message' => $message])

    <form action="/seasons/{{ $seasonId }}/episodes/watch" method="post">
        @csrf
        <ul class="list-group">
            @foreach ($episodes as $episode)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio {{ $episode['number'] }}
                    <input type="checkbox" name="episodes[]" value="{{ $episode['id'] }}"
                        {{ $episode['watched'] ? 'checked' : '' }}>
                </li>
            @endforeach
        </ul>
        <button class="btn btn-primary mt-2 mb-2">Salvar</button>
    </form>
@endsection
