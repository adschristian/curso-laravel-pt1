<?php

namespace App\Services;

use App\Models\{Serie, Season, Episode};
use Illuminate\Support\Facades\DB;

class SerieDestroyService
{
    public function destroy(int $id): string
    {
        $serieName = '';

        DB::beginTransaction();
        /** @var Serie */
        $serie = Serie::find($id);

        $serieName = $serie->name;
        $this->destroySeasons($serie);

        $serie->delete();
        DB::commit();

        return $serieName;
    }

    private function destroySeasons(Serie $serie)
    {
        $serie->seasons->each(function (Season $season) {
            $this->destroyEpisodes($season);
            $season->delete();
        });
    }

    private function destroyEpisodes(Season $season)
    {
        $season->episodes->each(function (Episode $episode) {
            $episode->delete();
        });
    }
}
