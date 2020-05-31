<?php

declare(strict_types=1);


namespace App\Core\Records\Actions;


use App\Core\Records\DTO\ExerciseDTO;
use App\Core\Records\Models\Exercise;
use App\Core\Records\Storage\ExerciseStorage;

final class UpdateExerciseAction
{
    private ExerciseStorage $exercises;

    public function __construct(ExerciseStorage $exercises)
    {
        $this->exercises = $exercises;
    }

    public function execute(ExerciseDTO $dto, int $id): Exercise
    {
        /** @var Exercise $exercise */
        $exercise = $this->exercises->getById($id);
        $exercise->edit(
            $dto->name,
            $dto->description
        );

        return $this->exercises->save($exercise);
    }
}
