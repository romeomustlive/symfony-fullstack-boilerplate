<?php


namespace App\Apps\External\Pub\Controller\Sport\Result;


use App\Auth\Application\Me\MeQuery;
use App\Auth\Application\Me\MeResponse;
use App\Shared\Domain\ValueObject\Uuid;
use App\Shared\Infrastructure\Symfony\ApiController;
use App\Sport\Result\Application\Create\CreateResultCommand;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class ResultCreateController extends ApiController
{
    public function __invoke(Request $request): JsonResponse
    {
        /** @var MeResponse $me */
        $me = $this->ask(new MeQuery());

        $this->exec(
            new CreateResultCommand(
                Uuid::random(),
                $request->get('weight'),
                $request->get('count'),
                $request->get('exerciseId'),
                $me->id()
            )
        );

        return new JsonResponse([
            'message' => 'Result successfully created.'
        ], 201);
    }
}