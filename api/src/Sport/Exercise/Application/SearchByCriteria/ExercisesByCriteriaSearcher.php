<?php


namespace App\Sport\Exercise\Application\SearchByCriteria;


use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filters;
use App\Shared\Domain\Criteria\Order;
use App\Sport\Exercise\Domain\ExerciseRepository;

final class ExercisesByCriteriaSearcher
{
    private ExerciseRepository $repository;

    public function __construct(ExerciseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function search(Filters $filters, Order $order, ?int $page, ?int $pageSize): array
    {
        $criteria = new Criteria($filters, $order, $page, $pageSize);

        return $this->repository->matching($criteria);
    }
}