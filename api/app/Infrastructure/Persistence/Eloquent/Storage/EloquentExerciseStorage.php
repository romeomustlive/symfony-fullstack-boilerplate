<?php

declare(strict_types=1);


namespace App\Infrastructure\Persistence\Eloquent\Storage;


use App\Core\Records\Models\Exercise;
use App\Core\Records\Storage\ExerciseStorage;
use App\Infrastructure\Persistence\Eloquent\AbstractEloquentStorage;

final class EloquentExerciseStorage extends AbstractEloquentStorage implements ExerciseStorage
{
    protected $model = Exercise::class;
}
