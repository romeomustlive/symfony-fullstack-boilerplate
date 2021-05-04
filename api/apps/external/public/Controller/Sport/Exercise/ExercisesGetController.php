<?php


namespace App\Apps\External\Pub\Controller\Sport\Exercise;


use App\Auth\Application\Me\MeQuery;
use App\Auth\Application\Me\MeResponse;
use App\Shared\Infrastructure\Symfony\ApiController;
use App\Sport\Exercise\Application\ExerciseResponse;
use App\Sport\Exercise\Application\ExercisesResponse;
use App\Sport\Exercise\Application\SearchByCriteria\SearchExerciseByCriteriaQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use function Lambdish\Phunctional\map;

final class ExercisesGetController extends ApiController
{
    public function __invoke(Request $request): JsonResponse
    {
        $page = $request->query->get('page');
        $pageSize = $request->query->get('pageSize');

        /** @var MeResponse $me */
        $me = $this->ask(new MeQuery());

        /** @var ExercisesResponse $response */
        $response = $this->ask(
          new SearchExerciseByCriteriaQuery(
              $me->id(),
              $request->query->get('title'),
              $request->query->get('order_by'),
              $request->query->get('order'),
              null === $page ? 1 : (int) $page,
              null === $pageSize ? 10 : (int) $pageSize
          )
        );

        return new JsonResponse([
                'items' => map(
                    fn(ExerciseResponse $exercise) => [
                        'id' => $exercise->id(),
                        'title' => $exercise->title(),
                        'description' => $exercise->description()
                    ],
                    $response->exercises()
                ),
                'meta' => [
                    'currentPage' => null === $page ? 1 : $page,
                    'pageCount' => $response->pageCount(),
                    'nextPage' => $page >= $response->pageCount() ? $response->pageCount() : $page + 1,
                    'prevPage' => $page - 1 > 0 ? $page -1 : 1,
                    'totalPages' => $response->pageCount()
                ]
        ]

        , 200);
    }
}