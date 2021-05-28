<?php


namespace App\Sport\Result\Application\SearchByCriteria;


use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\Bus\Query\Response;
use App\Shared\Domain\Criteria\Filters;
use App\Shared\Domain\Criteria\Order;
use App\Shared\Domain\Utils;
use App\Sport\Result\Application\ResultResponse;
use App\Sport\Result\Application\ResultsResponse;
use App\Sport\Result\Domain\Result;
use function Lambdish\Phunctional\map;

final class SearchResultsByCriteriaQueryHandler implements QueryHandler
{
    private ResultsByCriteriaSearcher $searcher;

    public function __construct(ResultsByCriteriaSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(SearchResultsByCriteriaQuery $query): Response
    {
        $filterValues = $this->extractFilterValuesFromQuery($query);

        $filters = Filters::fromValues($filterValues);
        $order = Order::fromValues($query->orderBy(), $query->order());

        [$items, $pageCount, $totalCount] = $this->searcher->search($filters, $order, $query->page(), $query->pageSize());

        return new ResultsResponse($totalCount, $pageCount, ...map($this->toResponse(), $items));
    }

    private function toResponse(): callable
    {
        return static fn(Result $result) => new ResultResponse(
            $result->id()->value(),
            $result->weight()->value(),
            $result->count()->value(),
            Utils::dateToString($result->createdAt()),
            $result->exercise()->title()
        );
    }

    private function extractFilterValuesFromQuery(SearchResultsByCriteriaQuery $query): array
    {
        $filterValues = [];

        if (null !== $query->userId()) {
            $filterValues[] = [
                'field' => 'userId.value',
                'operator' => '=',
                'value' => $query->userId()
            ];
        }

        if (null !== $query->title()) {
            $filterValues[] = [
                'field' => 'title.value',
                'operator' => 'CONTAINS',
                'value' => $query->title()
            ];
        }

        return $filterValues;
    }
}