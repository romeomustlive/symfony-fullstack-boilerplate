<?php


namespace App\Apps\External\Pub\Controller\Sport\Result;


use App\Auth\Application\Me\MeQuery;
use App\Auth\Application\Me\MeResponse;
use App\Shared\Infrastructure\Symfony\ApiController;
use App\Shared\Infrastructure\Symfony\MetaResponse;
use App\Sport\Result\Application\ResultResponse;
use App\Sport\Result\Application\ResultsResponse;
use App\Sport\Result\Application\SearchByCriteria\SearchResultsByCriteriaQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use function Lambdish\Phunctional\map;

final class ResultsGetByCriteriaController extends ApiController
{
    public function __invoke(Request $request): JsonResponse
    {
        $page = $request->query->get('page');
        $pageSize = $request->query->get('pageSize');

        /** @var MeResponse $me */
        $me = $this->ask(new MeQuery());

        /** @var ResultsResponse $results */
        $results = $this->ask(
            new SearchResultsByCriteriaQuery(
                $me->id(),
                $request->query->get('title'),
                $request->query->get('order_by'),
                $request->query->get('order'),
                null === $page ? 1 : $page,
                null === $pageSize ? 10 : $pageSize
            )
        );

        return new JsonResponse([
            'items' => map(fn(ResultResponse $result) => [
                'id' => $result->id(),
                'exerciseTitle' => $result->exerciseTitle(),
                'weight' => $result->weight(),
                'count' => $result->count()
            ], $results->results()),
            'meta' => MetaResponse::toPrimitives($page, $results->pagesCount(), $results->totalItems())
        ]);
    }
}