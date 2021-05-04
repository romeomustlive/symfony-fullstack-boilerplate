<?php


namespace App\Sport\Exercise\Application\Update;


use App\Sport\Exercise\Domain\ExerciseDescription;
use App\Sport\Exercise\Domain\ExerciseId;
use App\Sport\Exercise\Domain\ExerciseRepository;
use App\Sport\Exercise\Domain\ExerciseTitle;

final class ExerciseUpdater
{
    private ExerciseRepository $repository;

    public function __construct(ExerciseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function update(ExerciseId $id, ExerciseTitle $title, ExerciseDescription $description): void
    {
        $exercise = $this->repository->search($id);

        $exercise->rename($title);
        $exercise->changeDescription($description);

        $this->repository->save($exercise);
    }
}