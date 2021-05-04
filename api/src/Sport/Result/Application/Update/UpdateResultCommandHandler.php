<?php


namespace App\Sport\Result\Application\Update;


use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Sport\Exercise\Domain\ExerciseId;
use App\Sport\Result\Domain\ResultCount;
use App\Sport\Result\Domain\ResultId;
use App\Sport\Result\Domain\ResultWeight;

final class UpdateResultCommandHandler implements CommandHandler
{
    private ResultUpdater $updater;

    public function __construct(ResultUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(UpdateResultCommand $command)
    {
        $id = new ResultId($command->id());
        $weight = new ResultWeight($command->weight());
        $count = new ResultCount($command->count());
        $exerciseId = new ExerciseId($command->exerciseId());

        $this->updater->update($id, $weight, $count, $exerciseId);
    }
}