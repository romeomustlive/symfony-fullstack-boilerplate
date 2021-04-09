<?php


namespace App\Auth\Application\Register;


use App\Auth\Domain\User;
use App\Auth\Domain\UserAlreadyExist;
use App\Auth\Domain\UserEmail;
use App\Auth\Domain\UserId;
use App\Auth\Domain\UserPassword;
use App\Auth\Domain\UserRepository;

final class UserCreator
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(UserId $id, UserEmail $email, UserPassword $password)
    {
        $user = new User(
            $id,
            $email,
            $password
        );

        $this->ensureUserAlreadyExist($user);
        $this->repository->save($user);
    }

    public function ensureUserAlreadyExist(User $user)
    {
        if (null !== $this->repository->search($user->email())) {
            throw new UserAlreadyExist();
        }
    }
}