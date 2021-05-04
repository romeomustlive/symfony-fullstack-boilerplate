<?php


namespace App\Sport\Result\Application\SearchByCriteria;


use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filters;
use App\Shared\Domain\Criteria\Order;
use App\Sport\Result\Domain\ResultRepository;

final class ResultsByCriteriaSearcher
{
    private ResultRepository $repository;

    public function __construct(ResultRepository $repository)
    {
        $this->repository = $repository;
    }

    public function search(Filters $filters, Order $order, ?int $page, ?int $pageSize): array
    {
        $criteria = new Criteria($filters, $order, $page, $pageSize);

        return $this->repository->matching($criteria);
    }
}