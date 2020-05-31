<?php

declare(strict_types=1);


namespace App\Infrastructure\Persistence\Eloquent\Queries;


use App\Core\Records\Models\Exercise;
use App\Core\Records\Queries\ExerciseQuery;
use Illuminate\Support\Facades\DB;

final class EloquentExerciseQuery implements ExerciseQuery
{
    public function getAll()
    {
        return Exercise::all();
    }

    public function getAllByUser(int $userId)
    {
        return DB::table('records_exercises')->where('user_id', $userId)->get();
    }

    public function getById(int $id)
    {
        return DB::table('records_exercises')->where('id', $id)->first();
    }
}
