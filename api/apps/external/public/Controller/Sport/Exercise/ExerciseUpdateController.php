<?php


namespace App\Apps\External\Pub\Controller\Sport\Exercise;


use App\Shared\Infrastructure\Symfony\ApiController;
use App\Sport\Exercise\Application\Update\UpdateExerciseCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class ExerciseUpdateController extends ApiController
{
    public function __invoke(string $id, Request $request): JsonResponse
    {
        $this->exec(
            new UpdateExerciseCommand($id, $request->get('title'), $request->get('description'))
        );

        return new JsonResponse([
            'message' => 'Exercise successfully updated'
        ], 201);
    }
}