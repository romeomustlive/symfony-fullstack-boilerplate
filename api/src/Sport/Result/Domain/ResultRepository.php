<?php


namespace App\Sport\Result\Domain;


use App\Shared\Domain\Criteria\Criteria;

interface ResultRepository
{
    public function save(Result $result): void;

    public function search(ResultId $resultId): Result;

    public function matching(Criteria $criteria): array;
}