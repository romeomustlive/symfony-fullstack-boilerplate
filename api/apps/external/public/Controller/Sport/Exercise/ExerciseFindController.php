<?php


namespace App\Apps\External\Pub\Controller\Sport\Exercise;


use App\Shared\Infrastructure\Symfony\ApiController;
use App\Sport\Exercise\Application\Find\ExerciseResponse;
use App\Sport\Exercise\Application\Find\FindExerciseQuery;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ExerciseFindController extends ApiController
{
    public function __invoke(string $id): JsonResponse
    {
        /** @var ExerciseResponse $response */
        $response = $this->ask(
            new FindExerciseQuery($id)
        );

        return new JsonResponse([
            'id' => $response->id(),
            'title' => $response->title(),
            'description' => $response->description()
        ], 200);
    }
}