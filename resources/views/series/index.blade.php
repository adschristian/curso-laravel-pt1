@extends('layout')

@section('header')
    Séries
@endsection

@section('content')
    @includeWhen(!empty($message), 'message', ['message' => $message])

    @auth
        <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>
    @endauth
    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="serie-name-{{ $serie['id'] }}">{{ $serie['name'] }}</span>

                <div class="input-group w-50" hidden id="input-serie-name-{{ $serie['id'] }}">
                    <input type="text" class="form-control" value="{{ $serie['name'] }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="editSerie({{ $serie['id'] }})">
                            <i class="fas fa-check"></i>
                        </button>
                        @csrf
                    </div>
                </div>

                <span class="d-flex">
                    @auth
                        <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $serie['id'] }})">
                            <i class="fas fa-edit"></i>
                        </button>
                    @endauth
                    <a href="series/{{ $serie['id'] }}/seasons" class="btn btn-info btn-sm mr-1">
                        <i class="fas fa-external-link-alt"></i>
                    </a>

                    @auth
                        <form action="/series/destroy/{{ $serie['id'] }}" method="post"
                            onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($serie['name']) }}?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    @endauth
                </span>
            </li>
        @endforeach
    </ul>

    <script>
        function toggleInput(serieId) {
            const serieNameElement = document.getElementById(`serie-name-${serieId}`);
            const inputSerieNameElement = document.getElementById(`input-serie-name-${serieId}`);

            if (serieNameElement.hasAttribute('hidden')) {
                serieNameElement.removeAttribute('hidden');
                inputSerieNameElement.hidden = true;
                return;
            }
            inputSerieNameElement.removeAttribute('hidden');
            serieNameElement.hidden = true;
        }

        function editSerie(serieId) {
            let formData = new FormData();
            const nameSerie = document.querySelector(`#input-serie-name-${serieId} > input`).value;
            const token = document.querySelector(`input[name="_token"]`).value;

            formData.append('name', nameSerie);
            formData.append('_token', token);

            const url = `/series/${serieId}/edit`;
            fetch(url, {
                body: formData,
                method: 'POST'
            }).then(() => {
                toggleInput(serieId);
                const serieNameElement = document.getElementById(`serie-name-${serieId}`);
                serieNameElement.textContent = nameSerie;
            });
        }
    </script>
@endsection
