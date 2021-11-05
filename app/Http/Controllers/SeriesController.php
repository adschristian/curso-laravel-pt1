<?php

namespace App\Http\Controllers;

use App\Http\Requests\SerieFormRequest;
use App\Models\Season;
use App\Models\Serie;
use App\Services\SerieCreatorService;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('name')->get()->toArray();
        $message = $request->session()->get('message');
        $request->session()->remove('message');

        return view('series.index', compact('series', 'message'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SerieFormRequest $request, SerieCreatorService $service)
    {
        $serie = $service->create(
            $request->post('name'),
            $request->post('number_of_seasons'),
            $request->post('number_of_episodes')
        );

        $request->session()->flash('message', "Série {$serie->id} cadastrada com sucesso.");

        return redirect()->route('series.index');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        Serie::destroy($id);

        $request->session()->flash('message', 'Série removida com sucesso.');

        return redirect()->route('series.index');
    }
}
