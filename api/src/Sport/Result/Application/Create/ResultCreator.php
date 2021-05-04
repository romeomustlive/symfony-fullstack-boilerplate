<?php


namespace App\Sport\Result\Application\Create;

use App\Sport\Exercise\Application\Find\ExerciseFinder;
use App\Sport\Exercise\Domain\ExerciseId;
use App\Sport\Result\Domain\Result;
use App\Sport\Result\Domain\ResultCount;
use App\Sport\Result\Domain\ResultId;
use App\Sport\Result\Domain\ResultRepository;
use App\Sport\Result\Domain\ResultUserId;
use App\Sport\Result\Domain\ResultWeight;
use DateTimeImmutable;

final class ResultCreator
{
    private ResultRepository $repository;
    private ExerciseFinder $finder;

    public function __construct(ResultRepository $repository, ExerciseFinder $finder)
    {
        $this->repository = $repository;
        $this->finder = $finder;
    }

    public function create(
        ResultId $id,
        ResultWeight $weight,
        ResultCount $count,
        ResultUserId $userId,
        DateTimeImmutable $createdAt,
        ExerciseId $exerciseId
    ): void {
        $exercise = $this->finder->find($exerciseId);

        $result = Result::create($id, $weight, $count, $userId, $createdAt, $exercise);

        $this->repository->save($result);
    }
}