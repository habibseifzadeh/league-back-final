<?php

namespace Tests\Feature;

use App\Models\Championship;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TeamTest extends MyTestCase
{

    private $baseUrl = '/api/team';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_count()
    {
        $response = $this->get($this->baseUrl . '/count');

        $response->assertStatus(200);
        $this->assertEquals(2, $response->content());
    }

    public function test_allAwards() {
        $response = $this->get($this->baseUrl . '/allAwards');

        $response->assertJson([
            ['name' => 'Team 1', 'award' => 0],
            ['name' => 'Team 2', 'award' => 0]
        ]);
    }
}
