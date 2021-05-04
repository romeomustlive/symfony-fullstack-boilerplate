<?php


namespace App\Sport\Result\Application\Update;



use App\Sport\Exercise\Application\Find\ExerciseFinder;
use App\Sport\Exercise\Domain\ExerciseId;
use App\Sport\Result\Application\Find\ResultFinder;
use App\Sport\Result\Domain\ResultCount;
use App\Sport\Result\Domain\ResultId;
use App\Sport\Result\Domain\ResultRepository;
use App\Sport\Result\Domain\ResultWeight;

final class ResultUpdater
{
    private ExerciseFinder $exerciseFinder;
    private ResultFinder $resultFinder;
    private ResultRepository $repository;

    public function __construct(ExerciseFinder $exerciseFinder, ResultFinder $resultFinder, ResultRepository $repository)
    {
        $this->exerciseFinder = $exerciseFinder;
        $this->resultFinder = $resultFinder;
        $this->repository = $repository;
    }

    public function update(ResultId $id, ResultWeight $weight, ResultCount $count, ExerciseId $exerciseId): void
    {
        $result = $this->resultFinder->find($id);
        $exercise = $this->exerciseFinder->find($exerciseId);

        $result->attachExercise($exercise);
        $result->changeWeight($weight);
        $result->changeCount($count);

        $this->repository->save($result);
    }
}