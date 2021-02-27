<?php


namespace App\Repository;


interface ChampionshipRepositoryInterface extends BaseRepository
{

    public function oneDay($day);

    public function days();

    public function truncate();

    public function findByTeams($firstTeamId, $secondTeamId, $day);

}
