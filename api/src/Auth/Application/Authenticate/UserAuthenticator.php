<?php


namespace App\Auth\Application\Authenticate;


use App\Auth\Domain\InvalidCredentials;
use App\Auth\Domain\User;
use App\Auth\Domain\UserEmail;
use App\Auth\Domain\UserRepository;

final class UserAuthenticator
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function authenticate(UserEmail $email, string $password)
    {
        /** @var User|null $user */
        $user = $this->repository->search($email);

        $this->ensureUserExist($user);
        $this->ensurePasswordMatch($user, $password);
    }

    private function ensureUserExist(?User $user)
    {
        if (null === $user) {
            throw new InvalidCredentials();
        }
    }

    private function ensurePasswordMatch(?User $user, string $password)
    {
        if (!$user->verifyPassword($password)) {
            throw new InvalidCredentials();
        }
    }
}