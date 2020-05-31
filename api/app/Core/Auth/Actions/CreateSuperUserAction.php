<?php

declare(strict_types=1);


namespace App\Core\Auth\Actions;



use App\Core\Auth\DTO\CreateSuperUserDTO;
use App\Core\Auth\Models\User;
use App\Core\Auth\Services\UserCreator;

final class CreateSuperUserAction
{
    private UserCreator $userCreator;

    public function __construct(UserCreator $userCreator)
    {
        $this->userCreator = $userCreator;
    }

    public function execute(CreateSuperUserDTO $dto): User
    {
        $user = User::register(
            $dto->name,
            $dto->email,
            $dto->password
        );

        return $this->userCreator->create($user);
    }
}
