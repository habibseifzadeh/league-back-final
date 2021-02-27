<?php


namespace App\Repository\Eloquent;


use App\Models\Team;
use App\Repository\TeamRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class TeamRepository
 * @package App\Repository\Eloquent
 */
class TeamRepository implements TeamRepositoryInterface
{

    /**
     * @param $attributes
     * @return int
     */
    public function create($attributes): int
    {
        $team = Team::create($attributes);
        return $team->id;
    }

    /**
     * @param $team
     */
    public function save($team): void
    {
        $team->save();
    }

    /**
     * @param $team
     */
    public function delete($team): void
    {
        $team->delete();
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Team::all();
    }

    /**
     * @param $id
     * @return Team
     */
    public function find($id): Team
    {
        return Team::find($id);
    }

    /**
     * @param Team $team
     * @return int
     */
    public function awards($team): int
    {
        $awards = 0;
        $firstChampionships = $team->firstTeamChampionships()->get();
        foreach ($firstChampionships as $championship) {
            $awards += $championship->first_team_award;
        }
        $secondChampionships = $team->secondTeamChampionships()->get();
        foreach ($secondChampionships as $championship) {
            $awards += $championship->second_team_award;
        }
        return $awards;
    }

    /**
     * @return Collection
     */
    public function allAwards(): Collection
    {
        $teams = $this->all();
        foreach ($teams as $team) {
            $team->award = $this->awards($team);
        }
        return $teams;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return Team::count();
    }
}
