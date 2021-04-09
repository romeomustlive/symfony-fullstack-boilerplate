<?php


namespace App\Apps\External\Pub\Controller\Auth;


use App\Auth\Application\Authenticate\AuthenticateUserCommand;
use App\Auth\Application\Token\TokenQuery;
use App\Auth\Application\Token\TokenResponse;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class LoginController extends ApiController
{
    public function __invoke(Request $request): JsonResponse
    {
        $this->exec(
            new AuthenticateUserCommand(
                $request->get('email'),
                $request->get('password')
            )
        );

        /** @var TokenResponse $response */
        $response = $this->ask(new TokenQuery($request->get('email')));

        return new JsonResponse(
            [
                'token' => $response->token()
            ]
        );
    }
}