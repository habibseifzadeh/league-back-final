<?php


namespace Tests\Feature;


use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class MyTestCase extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        DB::table('championships')->delete();
        DB::table('teams')->delete();
        Team::create(['name' => 'Team 1']);
        Team::create(['name' => 'Team 2']);
    }

}
