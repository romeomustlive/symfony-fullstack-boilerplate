<?php


namespace App\Sport\Exercise\Application\Delete;


use App\Sport\Exercise\Application\Find\ExerciseFinder;
use App\Sport\Exercise\Domain\ExerciseId;
use App\Sport\Exercise\Domain\ExerciseRepository;

final class ExerciseRemover
{
    private ExerciseFinder $finder;
    private ExerciseRepository $repository;

    public function __construct(ExerciseFinder $finder, ExerciseRepository $repository)
    {
        $this->finder = $finder;
        $this->repository = $repository;
    }

    public function remove(ExerciseId $id): void
    {
        $exercise = $this->finder->find($id);

        $this->repository->delete($exercise);
    }
}