<?php


namespace App\Sport\Exercise\Application\Create;


use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Sport\Exercise\Domain\ExerciseDescription;
use App\Sport\Exercise\Domain\ExerciseId;
use App\Sport\Exercise\Domain\ExerciseTitle;
use App\Sport\Exercise\Domain\ExerciseUserId;

final class CreateExerciseCommandHandler implements CommandHandler
{
    private ExerciseCreator $creator;

    public function __construct(ExerciseCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateExerciseCommand $command): void
    {
        $id = new ExerciseId($command->id());
        $title = new ExerciseTitle($command->title());
        $description = new ExerciseDescription($command->description());
        $userId = new ExerciseUserId($command->userId());

        $this->creator->create(
            $id,
            $title,
            $description,
            $userId
        );
    }
}