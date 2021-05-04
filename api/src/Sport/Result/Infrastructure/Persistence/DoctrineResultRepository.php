<?php


namespace App\Sport\Result\Infrastructure\Persistence;


use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\Sport\Result\Domain\Result;
use App\Sport\Result\Domain\ResultId;
use App\Sport\Result\Domain\ResultRepository;

final class DoctrineResultRepository extends DoctrineRepository implements ResultRepository
{
    public function save(Result $result): void
    {
        // TODO: Implement save() method.
    }

    public function search(ResultId $resultId): Result
    {
        // TODO: Implement search() method.
    }

    public function matching(Criteria $criteria): array
    {
        // TODO: Implement matching() method.
    }
}