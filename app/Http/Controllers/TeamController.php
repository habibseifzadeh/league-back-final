<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Repository\TeamRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

/**
 * Class TeamController
 * @package App\Http\Controllers
 */
class TeamController extends Controller
{

    private $teamRepository;

    /**
     * TeamController constructor.
     * @param TeamRepositoryInterface $teamRepository
     */
    public function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->teamRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->teamRepository->create(['name' => $request->name, 'strength' => $request->strength]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $team->name = $request->name ?? $team->name;
        $team->strength = $request->strength ?? $team->strength;
        $this->teamRepository->save($team);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        try {
            $this->teamRepository->delete($team);
            return 1;
        } catch (QueryException $e) {
            return 0;
        }
    }

    /**
     * @return int
     */
    public function count(): int {
        return $this->teamRepository->count();
    }

    /**
     * @param Team $team
     * @return int
     */
    public function awards(Team $team): int {
        return $this->teamRepository->awards($team);
    }

    /**
     * @return Collection
     */
    public function allAwards(): Collection {
        return $this->teamRepository->allAwards();
    }
}
