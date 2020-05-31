<?php

declare(strict_types=1);


namespace App\Core\Records\Actions;


use App\Core\Records\DTO\ResultDTO;
use App\Core\Records\Factories\ResultFactory;
use App\Core\Records\Models\Result;
use App\Core\Records\Storage\ExerciseStorage;
use App\Core\Records\Storage\ResultStorage;

final class CreateResultAction
{
    private ResultStorage $results;

    private ExerciseStorage $exercises;

    private ResultFactory $resultFactory;

    public function __construct(ResultStorage $results, ExerciseStorage $exercises, ResultFactory $resultFactory)
    {
        $this->results = $results;
        $this->exercises = $exercises;
        $this->resultFactory = $resultFactory;
    }

    public function execute(ResultDTO $dto): Result
    {
        $result = $this->resultFactory->create($dto->weight, $dto->quantity);
        $exercise = $this->exercises->getById($dto->exercise_id);
        $result->exercise()->associate($exercise);

        $this->results->save($result);

        return $result;
    }
}
