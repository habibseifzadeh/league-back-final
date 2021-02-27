<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Championship extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'first_team',
        'second_team',
        'first_team_award',
        'second_team_award',
        'first_team_goals',
        'second_team_goals',
    ];

    public function firstTeam()
    {
        return $this->belongsTo(Team::class, 'first_team', 'id');
    }

    public function secondTeam()
    {
        return $this->belongsTo(Team::class, 'second_team', 'id');
    }

    public function teams()
    {
        $this->firstTeam()->union($this->secondTeam());
    }
}
