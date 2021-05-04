<?php


namespace App\Sport\Exercise\Application\Find;


use App\Sport\Exercise\Domain\Exercise;
use App\Sport\Exercise\Domain\ExerciseId;
use App\Sport\Exercise\Domain\ExerciseNotFound;
use App\Sport\Exercise\Domain\ExerciseRepository;

final class ExerciseFinder
{
    private ExerciseRepository $repository;

    public function __construct(ExerciseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function find(ExerciseId $id): ?Exercise
    {
        $exercise = $this->repository->search($id);

        if (null === $exercise) {
            throw new ExerciseNotFound();
        }

        return $exercise;
    }
}