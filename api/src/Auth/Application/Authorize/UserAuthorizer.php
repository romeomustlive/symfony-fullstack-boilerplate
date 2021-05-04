<?php


namespace App\Auth\Application\Authorize;


use App\Auth\Domain\InvalidToken;
use App\Auth\Domain\User;
use App\Auth\Domain\UserEmail;
use App\Auth\Domain\UserRepository;

final class UserAuthorizer
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function authorize(UserEmail $email)
    {
        $user = $this->repository->search($email);

        $this->ensureUserExist($user);
    }

    public function ensureUserExist(User $user)
    {
        if (null === $user) {
            throw new InvalidToken();
        }
    }
}