<?php


namespace App\Sport\Exercise\Application\Update;


use App\Sport\Exercise\Domain\ExerciseDescription;
use App\Sport\Exercise\Domain\ExerciseId;
use App\Sport\Exercise\Domain\ExerciseTitle;

final class UpdateExerciseCommandHandler
{
    private ExerciseUpdater $updater;

    public function __construct(ExerciseUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(UpdateExerciseCommand $command): void
    {
        $id = new ExerciseId($command->id());
        $title = new ExerciseTitle($command->title());
        $description = new ExerciseDescription($command->title());

        $this->updater->update($id, $title, $description);
    }
}