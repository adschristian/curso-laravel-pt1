<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EpisodesController extends Controller
{
    public function index(Season $season, Request $request)
    {
        $episodes = $season->episodes;
        $seasonId = $season->id;
        $message = $request->session()->get('message');

        return view('episodes.index', compact(
            'episodes',
            'seasonId',
            'message'
        ));
    }

    public function watch(Season $season, Request $request)
    {
        $watchedEpisodes = $request->episodes;
        $episodes = $season->episodes;
        $this->watchInternal($episodes, $watchedEpisodes);
        $season->push();
        $request->session()->flash('message', 'Episódios marcados.');

        return redirect()->back();
    }

    private function watchInternal(Collection $episodes, ?array $watchedEpisodes)
    {
        $watchedEpisodes = $watchedEpisodes ?? [];
        $episodes->each(function (Episode $episode) use ($watchedEpisodes) {
            $episode->watched = in_array($episode->id, $watchedEpisodes);
        });
    }
}
