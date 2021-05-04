<?php


namespace App\Auth\Application\Authorize;


use App\Auth\Domain\UserEmail;
use App\Shared\Domain\Bus\Command\CommandHandler;

final class AuthorizeCommandHandler implements CommandHandler
{
    private UserAuthorizer $authorizer;

    public function __construct(UserAuthorizer $authorizer)
    {
        $this->authorizer = $authorizer;
    }

    public function __invoke(AuthorizeCommand $command)
    {
        $email = new UserEmail($command->username());

        $this->authorizer->authorize($email);
    }
}