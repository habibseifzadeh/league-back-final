<?php


namespace App\Util;


use App\Repository\ChampionshipRepositoryInterface;
use App\Repository\TeamRepositoryInterface;

/**
 * Class GameScheduler
 * @package App\Util
 */
class GameScheduler
{
    private $teams;
    private $teamRepository;
    private $championshipRepository;
    private $maxDay;
    private $game;

    /**
     * GameScheduler constructor.
     * @param TeamRepositoryInterface $teamRepository
     * @param ChampionshipRepositoryInterface $championshipRepository
     * @param Game $game
     */
    public function __construct(TeamRepositoryInterface $teamRepository,
                                ChampionshipRepositoryInterface $championshipRepository,
                                Game $game)
    {
        $this->teamRepository = $teamRepository;
        $this->championshipRepository = $championshipRepository;
        $this->game = $game;
    }

    /**
     * @param $maxDay
     * @return array
     */
    public function scheduleTillDay($maxDay): array {
        if (!$this->checkNumberOfTeams()) {
            return [
                'error' => 1,
                'message' => 'The number of teams must be the power of 2 (e.g., 2, 4, 8, ...)',
            ];
        }
        $this->maxDay = $maxDay;
        $this->teams = $this->teamRepository->all();

        $this->timetable(0, $this->teamRepository->count() - 1);

        return [
            'error' => 0,
            'message' => "Scheduling Day $maxDay done!",
        ];

    }

    /**
     * @return array
     */
    public function schedule(): array
    {
        if (!$this->checkNumberOfTeams()) {
            return [
                'error' => 1,
                'message' => 'The number of teams must be the power of 2 (e.g., 2, 4, 8, ...)',
            ];
        }
        $this->championshipRepository->truncate();
        $this->maxDay = $this->teamRepository->count() - 1;

        $this->teams = $this->teamRepository->all();
        $this->timetable(0, $this->teamRepository->count() - 1);

        return [
            'error' => 0,
            'message' => 'Scheduling done!',
        ];
    }

    /**
     * @param $i
     * @param $j
     */
    private function timetable($i, $j): void
    {
        if ($i + 1 === $j) {
            $this->game->aGame($this->teams[$i], $this->teams[$j], 1);
            return;
        }

        $mid = intdiv($i+$j, 2);
        $firstDay = intdiv($j-$i, 2) + 1;
        $this->timetable($i, $mid);
        $this->timetable($mid+1, $j);

        $teamTwo = $mid + 1;
        for($team1 = $i; $team1 <= $mid; $team1++) {
            $team2 = $teamTwo;
            for($day = $firstDay; $day <= $j - $i && $day <= $this->maxDay; $day++) {
                $this->game->aGame($this->teams[$team1], $this->teams[$team2], $day);
                $team2++;
                if($team2 > $j) {
                    $team2 = $mid + 1;
                }
            }
            $teamTwo++;
        }
    }

    /**
     * @return bool
     */
    private function checkNumberOfTeams(): bool
    {
        $c = $this->teamRepository->count();
        if ($c <= 1) {
            return false;
        }
        while ($c > 1) {
            if ($c % 2 !== 0) {
                return false;
            }
            $c /= 2;
        }

        return true;
    }

}
