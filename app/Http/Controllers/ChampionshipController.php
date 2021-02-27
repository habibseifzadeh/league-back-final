<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use App\Models\Team;
use App\Repository\ChampionshipRepositoryInterface;
use App\Util\GameScheduler;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Class ChampionshipController
 * @package App\Http\Controllers
 */
class ChampionshipController extends Controller
{

    private $championshipRepository;
    private $gameScheduler;

    /**
     * ChampionshipController constructor.
     * @param ChampionshipRepositoryInterface $championshipRepository
     * @param GameScheduler $gameScheduler
     */
    public function __construct(ChampionshipRepositoryInterface $championshipRepository, GameScheduler $gameScheduler)
    {
        $this->championshipRepository = $championshipRepository;
        $this->gameScheduler = $gameScheduler;
    }

    /**
     * @param $day
     * @return Collection
     */
    public function oneDay($day): Collection {
        return $this->championshipRepository->oneDay($day);
    }

    /**
     *
     */
    public function truncate(): void {
        $this->championshipRepository->truncate();
    }

    /**
     * @return int
     */
    public function count(): int {
        return $this->championshipRepository->count();
    }

    /**
     * @return array
     */
    public function schedule(): array
    {
        return $this->gameScheduler->schedule();
    }

    /**
     * @param $day
     * @return string[]
     */
    public function scheduleTillDay($day): array
    {
        if($day < 1) {
            return [
                'error' => '1',
                'message' => 'The day must be more than 1',
            ];
        }

        return $this->gameScheduler->scheduleTillDay($day);
    }

    /**
     * @return Collection
     */
    public function days(): Collection {
        return $this->championshipRepository->days();
    }
}
