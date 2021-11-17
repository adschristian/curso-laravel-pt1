<?php

namespace Tests\Feature;

use App\Models\Serie;
use App\Services\SerieCreateService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SerieCreatorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateSerie()
    {
        $serieCreator = new SerieCreateService();
        $name = 'nome teste';
        $newSerie = $serieCreator->create($name, 1, 1);

        $this->assertInstanceOf(Serie::class, $newSerie);
        $this->assertDatabaseHas('series', ['name' => $name]);
        $this->assertDatabaseHas('seasons', ['serie_id' => $newSerie->id]);
        $this->assertDatabaseHas('episodes', ['number' => 1]);
    }
}
