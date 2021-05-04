<?php


namespace App\Sport\Exercise\Application\Create;


use App\Sport\Exercise\Domain\Exercise;
use App\Sport\Exercise\Domain\ExerciseDescription;
use App\Sport\Exercise\Domain\ExerciseId;
use App\Sport\Exercise\Domain\ExerciseRepository;
use App\Sport\Exercise\Domain\ExerciseTitle;
use App\Sport\Exercise\Domain\ExerciseUserId;


final class ExerciseCreator
{
    private ExerciseRepository $repository;

    public function __construct(ExerciseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(ExerciseId $id, ExerciseTitle $weight, ExerciseDescription $result, ExerciseUserId $userId): void
    {
        $exercise = Exercise::create(
            $id,
            $weight,
            $result,
            $userId
        );

        $this->repository->save($exercise);
    }
}