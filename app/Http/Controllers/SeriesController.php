<?php

namespace App\Http\Controllers;

use App\Http\Requests\SerieFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Serie;
use App\Services\SerieCreateService;
use App\Services\SerieDestroyService;
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

    public function store(SerieFormRequest $request, SerieCreateService $service)
    {
        $serie = $service->create(
            $request->post('name'),
            $request->post('number_of_seasons'),
            $request->post('number_of_episodes')
        );

        $request->session()->flash('message', "Série {$serie->name} cadastrada com sucesso.");

        return redirect()->route('series.index');
    }

    public function destroy(Request $request, SerieDestroyService $service)
    {
        $serieName = $service->destroy($request->id);

        $request->session()->flash('message', "Série {$serieName} removida com sucesso.");

        return redirect()->route('series.index');
    }
}
