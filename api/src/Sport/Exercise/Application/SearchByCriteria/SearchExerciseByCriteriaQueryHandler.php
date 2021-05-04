<?php


namespace App\Sport\Exercise\Application\SearchByCriteria;


use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\Criteria\Filters;
use App\Shared\Domain\Criteria\Order;
use App\Sport\Exercise\Application\ExerciseResponse;
use App\Sport\Exercise\Application\ExercisesResponse;
use App\Sport\Exercise\Domain\Exercise;
use function Lambdish\Phunctional\map;

final class SearchExerciseByCriteriaQueryHandler implements QueryHandler
{
    private ExercisesByCriteriaSearcher $searcher;

    public function __construct(ExercisesByCriteriaSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(SearchExerciseByCriteriaQuery $query): ExercisesResponse
    {
        $filterValues = $this->extractFilterValuesFromQuery($query);

        $filters = Filters::fromValues($filterValues);
        $order = Order::fromValues($query->orderBy(), $query->order());

        [$items, $pageCount, $totalCount] = $this->searcher->search($filters, $order, $query->page(), $query->pageSize());

        return new ExercisesResponse($pageCount, $totalCount, ...map($this->toResponse(), $items));
    }

    private function toResponse(): callable
    {
        return static fn(Exercise $exercise) => new ExerciseResponse(
            $exercise->id()->value(),
            $exercise->title()->value(),
            $exercise->description()->value()
        );
    }

    private function extractFilterValuesFromQuery(SearchExerciseByCriteriaQuery $query): array
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