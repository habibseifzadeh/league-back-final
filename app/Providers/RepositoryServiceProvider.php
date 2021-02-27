<?php

namespace App\Providers;

use App\Repository\ChampionshipRepositoryInterface;
use App\Repository\Eloquent\ChampionshipRepository;
use App\Repository\Eloquent\TeamRepository;
use App\Repository\TeamRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
        $this->app->bind(ChampionshipRepositoryInterface::class, ChampionshipRepository::class);
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
