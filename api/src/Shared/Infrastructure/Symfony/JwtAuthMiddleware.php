<?php


namespace App\Shared\Infrastructure\Symfony;


use App\Auth\Application\Authorize\AuthorizeCommand;
use App\Auth\Domain\InvalidToken;
use App\Shared\Domain\Bus\Command\CommandBus;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\AuthorizationHeaderTokenExtractor;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;

final class JwtAuthMiddleware
{
    private JWTEncoderInterface $encoder;
    private CommandBus $commandBus;

    public function __construct(JWTEncoderInterface $encoder, CommandBus $commandBus)
    {
        $this->encoder = $encoder;
        $this->commandBus = $commandBus;
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $shouldAuthenticate = $event->getRequest()->attributes->get('auth', false);

        if ($shouldAuthenticate) {
            $extractor = new AuthorizationHeaderTokenExtractor(
                'Bearer',
                'Authorization'
            );
            $token = $extractor->extract($event->getRequest());
            $this->ensureTokenExist($token, $event);

            try {
                $username = $this->encoder->decode($token)['username'];
                $this->authenticate($username, $event);
            } catch (JWTDecodeFailureException $e) {
                $this->setAuthorizationFailedResponse($event);
            }
        }
    }

    private function ensureTokenExist(string $token, RequestEvent $event): void
    {
        if (null === $token) {
            $this->setForbiddenResponse($event);
        }
    }

    private function authenticate(string $username, RequestEvent $event): void
    {
        try {
            $this->commandBus->dispatch(
                new AuthorizeCommand($username)
            );
        } catch (InvalidToken $e) {
            $this->setForbiddenResponse($event);
        }
    }

    private function setAuthorizationFailedResponse(RequestEvent $event)
    {
        $event->setResponse(
            new JsonResponse(
                ['error' => 'Invalid or expired token'],
                Response::HTTP_UNAUTHORIZED
            )
        );
    }
}