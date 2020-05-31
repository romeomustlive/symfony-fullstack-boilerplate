<?php

declare(strict_types=1);


namespace App\Core\Records\Actions;


use App\Core\Records\DTO\ExerciseDTO;
use App\Core\Records\Factories\ExerciseFactory;
use App\Core\Records\Models\Exercise;
use App\Core\Records\Storage\ExerciseStorage;


final class CreateExerciseAction
{
    private ExerciseStorage $exercises;

    private ExerciseFactory $exerciseFactory;

    public function __construct(
        ExerciseStorage $exercises,
        ExerciseFactory $exerciseFactory
    ){
        $this->exercises = $exercises;
        $this->exerciseFactory = $exerciseFactory;
    }

    public function execute(ExerciseDTO $dto): Exercise
    {
        $exercise = $this->exerciseFactory->create($dto->name, $dto->description);

        $exercise->user()->associate(current_user());

        $this->exercises->save($exercise);

        return $exercise;
    }
}
