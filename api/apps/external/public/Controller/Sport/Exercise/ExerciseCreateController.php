<?php


namespace App\Apps\External\Pub\Controller\Sport\Exercise;


use App\Auth\Application\Me\MeQuery;
use App\Auth\Application\Me\MeResponse;
use App\Shared\Domain\ValueObject\Uuid;
use App\Shared\Infrastructure\Symfony\ApiController;
use App\Sport\Exercise\Application\Create\CreateExerciseCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class ExerciseCreateController extends ApiController
{
    public function __invoke(Request $request): JsonResponse
    {
        /** @var MeResponse $response */
        $response = $this->ask(
            new MeQuery()
        );

        $this->exec(
            new CreateExerciseCommand(
                Uuid::random(),
                $request->get('title'),
                $request->get('description'),
                $response->id()
            )
        );

        return new JsonResponse(
            [
                'message' => 'Exercise successfully created'
            ],
            201
        );
    }
}