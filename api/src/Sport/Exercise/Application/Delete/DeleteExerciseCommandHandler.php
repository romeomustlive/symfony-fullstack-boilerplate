<?php


namespace App\Sport\Exercise\Application\Delete;


use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Sport\Exercise\Domain\ExerciseId;

final class DeleteExerciseCommandHandler implements CommandHandler
{
    private ExerciseRemover $remover;

    public function __construct(ExerciseRemover $remover)
    {
        $this->remover = $remover;
    }

    public function __invoke(DeleteExerciseCommand $command)
    {
        $id = new ExerciseId($command->id());

        $this->remover->remove($id);
    }
}