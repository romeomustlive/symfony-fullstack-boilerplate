<?php


namespace App\Apps\External\Pub\Controller\Sport\Result;


use App\Shared\Infrastructure\Symfony\ApiController;
use App\Sport\Result\Application\Update\UpdateResultCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class ResultUpdateController extends ApiController
{
    public function __invoke(string $id, Request $request): JsonResponse
    {
        $this->exec(
            new UpdateResultCommand(
                $id,
                $request->get('weight'),
                $request->get('count'),
                $request->get('exerciseId')
            )
        );

        return new JsonResponse([], 204);
    }
}