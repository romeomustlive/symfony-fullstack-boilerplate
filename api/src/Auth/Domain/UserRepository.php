<?php


namespace App\Auth\Domain;


interface UserRepository
{
    public function save(User $user): void;

    public function search(UserEmail $email): ?User;
}