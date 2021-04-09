<?php


namespace App\Auth\Application\Register;


use App\Auth\Domain\UserEmail;
use App\Auth\Domain\UserId;
use App\Auth\Domain\UserPassword;
use App\Shared\Domain\Bus\Command\CommandHandler;

final class RegisterUserCommandHandler implements CommandHandler
{
    private UserCreator $creator;

    public function __construct(UserCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(RegisterUserCommand $command)
    {
        $id = new UserId($command->id());
        $email = new UserEmail($command->email());
        $password = new UserPassword($command->password());

        $this->creator->create(
            $id,
            $email,
            $password
        );
    }
}