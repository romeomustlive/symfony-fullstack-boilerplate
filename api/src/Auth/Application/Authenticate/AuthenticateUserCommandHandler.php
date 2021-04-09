<?php


namespace App\Auth\Application\Authenticate;


use App\Auth\Domain\UserEmail;
use App\Shared\Domain\Bus\Command\CommandHandler;

final class AuthenticateUserCommandHandler implements CommandHandler
{
    private UserAuthenticator $authenticator;

    public function __construct(UserAuthenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    public function __invoke(AuthenticateUserCommand $command): void
    {
        $email = new UserEmail($command->email());

        $this->authenticator->authenticate($email, $command->password());
    }
}