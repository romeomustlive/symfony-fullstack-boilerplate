<?php


namespace App\Apps\External\Pub\Controller\Auth;


use App\Auth\Application\Me\MeQuery;
use App\Auth\Application\Me\MeResponse;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class MeController extends ApiController
{
    public function __invoke(): JsonResponse
    {
        /** @var MeResponse $response */
        $response = $this->ask(
            new MeQuery()
        );

        return new JsonResponse([
            'id' => $response->id(),
            'email' => $response->email()
        ]);
    }
}