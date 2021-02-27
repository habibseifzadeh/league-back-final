<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'strength'];

    public function championships() {
        return $this->firstTeamChampionships()->union($this->secondTeamChampionships());
    }

    public function firstTeamChampionships() {
        return $this->hasMany(Championship::class, 'first_team', 'id');
    }

    public function secondTeamChampionships() {
        return $this->hasMany(Championship::class, 'second_team', 'id');
    }

}
