<?php


namespace App\Apps\External\Pub\Controller\Sport\Exercise;


use App\Shared\Infrastructure\Symfony\ApiController;
use App\Sport\Exercise\Application\Delete\DeleteExerciseCommand;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ExerciseDeleteController extends ApiController
{
    public function __invoke(string $id): JsonResponse
    {
        $this->exec(
            new DeleteExerciseCommand($id)
        );

        return new JsonResponse([], 204);
    }
}