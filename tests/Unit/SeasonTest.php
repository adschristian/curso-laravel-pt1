<?php

namespace Tests\Unit;

use App\Models\Episode;
use App\Models\Season;
use Tests\TestCase;

class SeasonTest extends TestCase
{
    /**
     * @var Season
     */
    private $season;

    protected function setUp(): void
    {
        parent::setUp();

        $season = new Season();
        $episode1 = new Episode();
        $episode2 = new Episode();
        $episode3 = new Episode();

        $episode1->watched = true;
        $episode2->watched = false;
        $episode3->watched = true;

        $season->episodes->add($episode1);
        $season->episodes->add($episode2);
        $season->episodes->add($episode3);

        $this->season = $season;
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $watchedEpisodes = $this->season->getWatchedEpisodes();
        $this->assertCount(2, $watchedEpisodes);

        foreach ($watchedEpisodes as $episode) {
            /** @var Episode $episode*/
            $this->assertTrue($episode->watched);
        }
    }

    public function testFindAllEpisodes()
    {
        $episodes = $this->season->episodes;

        $this->assertCount(3, $episodes);
    }
}
