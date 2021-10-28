<?php

namespace App\Http\Controllers;

use App\Http\Requests\SerieFormRequest;
use App\Models\Serie;
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

    public function store(SerieFormRequest $request)
    {
        $serie = new Serie($request->post());

        if ($serie->save()) {
            $request->session()->flash('message', 'Série cadastrada com sucesso.');

            return redirect()->route('series.index');
        }

        $request->session()->flash('message', 'Erro ao cadastrar série.');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        Serie::destroy($id);

        $request->session()->flash('message', 'Série removida com sucesso.');

        return redirect()->route('series.index');
    }
}
