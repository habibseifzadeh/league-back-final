<?php


namespace App\Repository;


interface TeamRepositoryInterface extends BaseRepository
{

    public function awards($team);

    public function allAwards();

}
