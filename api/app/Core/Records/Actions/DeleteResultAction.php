<?php

declare(strict_types=1);


namespace App\Core\Records\Actions;


use App\Core\Records\Models\Result;
use App\Core\Records\Storage\ResultStorage;

final class DeleteResultAction
{
    private ResultStorage $results;

    public function __construct(ResultStorage $results)
    {
        $this->results = $results;
    }

    public function execute(int $id): Result
    {
        $result = $this->results->getById($id);
        $this->results->delete($result);

        return $result;
    }
}
