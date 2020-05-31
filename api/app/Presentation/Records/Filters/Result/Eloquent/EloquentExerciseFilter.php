<?php

declare(strict_types=1);


namespace App\Presentation\Records\Filters\Result\Eloquent;


use App\Presentation\Records\Filters\Result\ExerciseFilter;

final class EloquentExerciseFilter implements ExerciseFilter
{
    public function filter($qs, $value)
    {
        return $qs->where('exercise_id', $value);
    }
}
