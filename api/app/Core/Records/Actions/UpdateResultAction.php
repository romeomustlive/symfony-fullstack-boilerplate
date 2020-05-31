<?php

declare(strict_types=1);


namespace App\Core\Records\Actions;


use App\Core\Records\DTO\ResultDTO;
use App\Core\Records\Models\Result;
use App\Core\Records\Storage\ExerciseStorage;
use App\Core\Records\Storage\ResultStorage;

final class UpdateResultAction
{
    private ResultStorage $results;

    private ExerciseStorage $exercises;

    public function __construct(ResultStorage $results)
    {
        $this->results = $results;
    }

    public function execute(ResultDTO $dto, int $id): Result
    {
        /** @var Result $result */
        $result = $this->results->getById($id);
        $result->edit(
            $dto->weight,
            $dto->quantity
        );

        $exercise = $this->exercises->getById($dto->exercise_id);
        $result->exercise()->associate($exercise);

        $this->exercises->save($result);

        return $result;
    }
}
