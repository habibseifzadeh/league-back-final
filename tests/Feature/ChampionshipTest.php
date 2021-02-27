<?php

namespace Tests\Feature;

use App\Models\Championship;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ChampionshipTest extends MyTestCase
{

    private $baseUrl = '/api/championship';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_schedule_number_problem()
    {
        $team = Team::create(['name' => 'Team 3']);

        $response = $this->get($this->baseUrl . '/schedule');

        $response->assertJson(['error' => 1]);

    }

    public function test_schedule_whole_eight_teams()
    {
        Team::create(['name' => 'Team 3']);
        Team::create(['name' => 'Team 4']);
        Team::create(['name' => 'Team 5']);
        Team::create(['name' => 'Team 6']);
        Team::create(['name' => 'Team 7']);
        Team::create(['name' => 'Team 8']);

        $response1 = $this->get($this->baseUrl . '/schedule');
        $response2 = $this->get($this->baseUrl . '/days');

        $response1->assertJson(['error' => 0]);
        $response2->assertSee(['day' => 7]);
        $response2->assertDontSee(['day' => 8]);
    }

    public function test_schedule_two_days_eight_teams()
    {
        Team::create(['name' => 'Team 3']);
        Team::create(['name' => 'Team 4']);
        Team::create(['name' => 'Team 5']);
        Team::create(['name' => 'Team 6']);
        Team::create(['name' => 'Team 7']);
        Team::create(['name' => 'Team 8']);

        $response1 = $this->get($this->baseUrl . '/scheduleTillDay/2');
        $response2 = $this->get($this->baseUrl . '/days');

        $response1->assertJson(['error' => 0]);
        $response2->assertSee(['day' => 2]);
        $response2->assertDontSee(['day' => 3]);
    }
}
