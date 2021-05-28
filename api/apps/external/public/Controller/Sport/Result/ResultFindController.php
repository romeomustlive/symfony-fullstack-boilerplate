<?php


namespace App\Apps\External\Pub\Controller\Sport\Result;


use App\Shared\Infrastructure\Symfony\ApiController;
use App\Sport\Result\Application\Find\FindResultQuery;
use App\Sport\Result\Application\ResultResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ResultFindController extends ApiController
{
    public function __invoke(?string $id): JsonResponse
    {
        /** @var ResultResponse $result */
        $result = $this->ask(
            new FindResultQuery($id)
        );

        return new JsonResponse([
            'id' => $result->id(),
            'weight' => $result->weight(),
            'count' => $result->count(),
            'exerciseTitle' => $result->exerciseTitle()
        ], 200);
    }
}