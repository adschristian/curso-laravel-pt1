<?php

namespace App\Services;

use App\Models\Season;
use App\Models\Serie;
use Illuminate\Support\Facades\DB;

class SerieCreateService
{
    public function create(string $serieName, int $numberOfSeasons, int $numberOfEpisodes): Serie
    {
        DB::beginTransaction();
        $serie = Serie::create([
            'name' => $serieName
        ]);
        $this->createSeasons($serie, $numberOfSeasons, $numberOfEpisodes);
        DB::commit();

        return $serie;
    }

    private function createSeasons(Serie $serie, int $numberOfSeasons, int $numberOfEpisodes): void
    {
        for ($counter = 1, $maxCounter = $numberOfSeasons; $counter <= $maxCounter; $counter++) {
            /** @var Season */
            $season = $serie->seasons()->create(['number' => $counter]);
            $this->createEpisodes($season, $numberOfEpisodes);
        }
    }

    private function createEpisodes(Season $season, int $numberOfEpisodes): void
    {
        for ($innerCounter = 1, $maxInnerCounter = $numberOfEpisodes; $innerCounter <= $maxInnerCounter; $innerCounter++) {
            $season->episodes()->create(['number' => $innerCounter]);
        }
    }
}
