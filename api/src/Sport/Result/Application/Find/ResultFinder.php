<?php


namespace App\Sport\Result\Application\Find;


use App\Sport\Result\Domain\Result;
use App\Sport\Result\Domain\ResultId;
use App\Sport\Result\Domain\ResultNotFound;
use App\Sport\Result\Domain\ResultRepository;

final class ResultFinder
{
    private ResultRepository $repository;

    public function __construct(ResultRepository $repository)
    {
        $this->repository = $repository;
    }

    public function find(ResultId $id): Result
    {
        $result = $this->repository->search($id);

        if (null === $result) {
            throw new ResultNotFound();
        }

        return $result;
    }
}