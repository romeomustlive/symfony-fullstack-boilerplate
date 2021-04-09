<?php


namespace App\Shared\Infrastructure\Symfony;


use App\Auth\Application\Authorize\AuthorizeCommand;
use App\Auth\Domain\InvalidToken;
use App\Shared\Domain\Bus\Command\CommandBus;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\AuthorizationHeaderTokenExtractor;
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

            $this->ensureTokenExist($token);
            $this->authenticate($token, $event);
        }
    }

    private function ensureTokenExist(string $token): void
    {
        if (null === $token) {
            throw new InvalidToken();
        }
    }

    private function authenticate(string $token, RequestEvent $event): void
    {
        $username = $this->encoder->decode($token)['username'];

        $this->commandBus->dispatch(
            new AuthorizeCommand($username)
        );

        $this->addUserDataToRequest($username, $event);
    }

    private function addUserDataToRequest(string $username, RequestEvent $event): void
    {
        $event->getRequest()->attributes->set('authenticated_username', $username);
    }
}