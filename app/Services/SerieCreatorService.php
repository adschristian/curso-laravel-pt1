<?php

namespace App\Services;

use App\Models\Serie;

class SerieCreatorService
{
    public function create(string $serieName, $numberOfEpisodes, $numberOfSeasons)
    {
        $serie = Serie::create([
            'name' => $serieName
        ]);

        for ($counter = 1, $maxCounter = $numberOfSeasons; $counter <= $maxCounter; $counter++) {
            /** @var Season */
            $season = $serie->seasons()->create(['number' => $counter]);

            for ($innerCounter = 1, $maxInnerCounter = $numberOfEpisodes; $innerCounter <= $maxInnerCounter; $innerCounter++) {
                $season->episodes()->create(['number' => $innerCounter]);
            }
        }

        return $serie;
    }
}
