<?php


namespace App\Auth\Infrastructure\Persistence;


use App\Auth\Domain\User;
use App\Auth\Domain\UserEmail;
use App\Auth\Domain\UserRepository;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineUserRepository extends DoctrineRepository implements UserRepository
{
    public function save(User $user): void
    {
        $this->persist($user);
    }

    public function search(UserEmail $email): ?User
    {
        /** @var User|null $user */
        $user = $this->repository(User::class)->findOneBy(['email.value' => $email->value()]);

        return $user;
    }
}