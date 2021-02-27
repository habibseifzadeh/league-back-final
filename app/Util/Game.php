<?php


namespace App\Util;


use App\Models\Championship;
use App\Repository\ChampionshipRepositoryInterface;
use App\Repository\TeamRepositoryInterface;

/**
 * Class Game
 * @package App\Util
 */
class Game
{

    private $championshipRepository;
    private $teamRepository;

    /**
     * Game constructor.
     * @param $championshipRepository
     * @param $teamRepository
     */
    public function __construct(ChampionshipRepositoryInterface $championshipRepository, TeamRepositoryInterface $teamRepository)
    {
        $this->championshipRepository = $championshipRepository;
        $this->teamRepository = $teamRepository;
    }

    /**
     * @param $firstTeam
     * @param $secondTeam
     * @param $day
     */
    public function aGame($firstTeam, $secondTeam, $day): void
    {
        if($this->championshipRepository->findByTeams($firstTeam->id, $secondTeam->id, $day)) return;

        $goalsOfFirstTeam = $this->numberOfGoalsBasedOnStrength($firstTeam->strength);
        $goalsOfSecondTeam = $this->numberOfGoalsBasedOnStrength($secondTeam->strength);
        $championship = new Championship([
            'first_team' => $firstTeam->id,
            'second_team' => $secondTeam->id,
            'day' => $day,
            'first_team_goals' => $goalsOfFirstTeam,
            'second_team_goals' => $goalsOfSecondTeam,
        ]);

        if($goalsOfFirstTeam > $goalsOfSecondTeam) {
            $championship->first_team_award = 3;
            $championship->second_team_award = 0;
        } elseif ($goalsOfFirstTeam < $goalsOfSecondTeam) {
            $championship->first_team_award = 0;
            $championship->second_team_award = 3;
        } else {
            $championship->first_team_award = 1;
            $championship->second_team_award = 1;
        }
        $this->championshipRepository->save($championship);
    }

    /**
     * @param $av
     * @param $sd
     * @return float
     */
    private function stats_rand_gen_normal($av, $sd): float
    {
        $x = mt_rand() / mt_getrandmax();
        $y = mt_rand() / mt_getrandmax();

        return sqrt(-2 * log($x)) * cos(2 * pi() * $y) * $sd + $av;
    }

    /**
     * @param $strength
     * @return int
     */
    private function numberOfGoalsBasedOnStrength($strength): int {
        $goals = $this->stats_rand_gen_normal($strength, 2);
        $goals = $goals < 0 ? 0 : $goals;
        return $goals;
    }

}
