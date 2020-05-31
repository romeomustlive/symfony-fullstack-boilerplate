<?php

declare(strict_types=1);


namespace App\Core\Auth\Services;



use App\Core\Auth\Models\User;
use App\Core\Auth\Storage\UserStorage;

final class UserCreator
{
    private UserStorage $users;

    public function __construct(UserStorage $users)
    {
        $this->users = $users;
    }

    public function create(User $user): User
    {
        return $this->users->save($user);
    }
}
