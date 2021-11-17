<?php

namespace Tests\Feature;

use App\Models\Serie;
use App\Services\SerieCreateService;
use App\Services\SerieDestroyService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SerieDestroyerTest extends TestCase
{
    use RefreshDatabase;

    private Serie $serie;

    protected function setUp(): void
    {
        parent::setUp();
        $service = new SerieCreateService();
        $this->serie = $service->create('new serie', 1, 1);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDestroySerie()
    {
        $this->assertDatabaseHas('series', ['id' => $this->serie->id]);

        $service = new SerieDestroyService();
        $name = $service->destroy($this->serie->id);

        $this->assertIsString($name);
        $this->assertEquals('new serie', $name);
        $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);
    }
}
