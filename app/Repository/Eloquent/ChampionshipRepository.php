<?php


namespace App\Repository\Eloquent;


use App\Models\Championship;
use App\Repository\ChampionshipRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ChampionshipRepository
 * @package App\Repository\Eloquent
 */
class ChampionshipRepository implements ChampionshipRepositoryInterface
{

    /**
     * @param $attributes
     * @return int
     */
    public function create($attributes): int
    {
        $championship = Championship::create($attributes);
        return $championship->id;
    }

    /**
     * @param $championship
     */
    public function save($championship): void
    {
        $championship->save();
    }

    /**
     * @param $championship
     */
    public function delete($championship): void
    {
        $championship->delete();
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Championship::all();
    }

    /**
     * @param $id
     * @return Championship
     */
    public function find($id): Championship
    {
        return Championship::find($id);
    }

    /**
     * @param $day
     * @return Collection
     */
    public function oneDay($day): Collection
    {
        return Championship
            ::select('championships.*', 't1.name as first_team_name', 't2.name as second_team_name')
            ->where('day', $day)
            ->join('teams as t1', 't1.id' , '=', 'first_team')
            ->join('teams as t2', 't2.id' , '=', 'second_team')
            ->get();
    }

    /**
     * @return Collection
     */
    public function days(): Collection
    {
        return Championship::select('day')->distinct()->get();
    }

    /**
     *
     */
    public function truncate(): void
    {
        Championship::truncate();
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return Championship::count();
    }

    /**
     * @param $firstTeamId
     * @param $secondTeamId
     * @param $day
     * @return mixed
     */
    public function findByTeams($firstTeamId, $secondTeamId, $day)
    {
        return Championship::where('first_team', $firstTeamId)->where('second_team', $secondTeamId)->where('day', $day)->first();
    }
}
