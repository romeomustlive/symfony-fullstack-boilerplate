<?php

declare(strict_types=1);


namespace App\Infrastructure\Persistence\Eloquent\Queries;


use App\Core\Records\Queries\ResultQuery;
use App\Presentation\Records\Filters\Result\ResultFilters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

final class EloquentResultQuery implements ResultQuery
{
    public function getById(int $id)
    {
        return DB::table('records_results')
            ->leftJoin(
                'records_exercises',
                'records_results.exercise_id',
                '=',
                'records_exercises.id'
            )
            ->where('records_results.id', '=', $id)
            ->select('records_results.*', 'records_exercises.name', 'records_exercises.description')
            ->first();
    }

    public function getByFilter(Request $request)
    {
        $qs = $this->getQs();

        $filterResult = (new ResultFilters($request))->filter($qs);

        return $filterResult->get();
    }

    private function getQs()
    {
        $subQuery = DB::table('records_exercises')
            ->where('user_id', current_user()->id);

        return DB::table('records_results')
            ->joinSub($subQuery, 'user_exercises', function ($join) {
                $join->on('records_results.exercise_id', '=', 'user_exercises.id');
            })
            ->orderBy('created_at', 'desc')
            ->select(
                'records_results.id',
                'records_results.weight',
                'records_results.quantity',
                'records_results.created_at',
                'records_results.updated_at',
                'user_exercises.name'
            );
    }
}
