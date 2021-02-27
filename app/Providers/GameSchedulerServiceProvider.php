<?php

namespace App\Providers;

use App\Util\Game;
use App\Util\GameScheduler;
use Illuminate\Support\ServiceProvider;

class GameSchedulerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GameScheduler::class, GameScheduler::class);
        $this->app->bind(Game::class, Game::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
