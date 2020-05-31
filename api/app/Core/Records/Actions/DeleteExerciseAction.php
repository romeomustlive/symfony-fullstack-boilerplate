<?php

declare(strict_types=1);


namespace App\Core\Records\Actions;


use App\Core\Records\Storage\ExerciseStorage;

final class DeleteExerciseAction
{
    private ExerciseStorage $exercises;

    public function __construct(ExerciseStorage $exercises)
    {
        $this->exercises = $exercises;
    }

    public function execute(int $id)
    {
        $exercise = $this->exercises->getById($id);
        $this->exercises->delete($exercise);

        return $exercise;
    }
}
