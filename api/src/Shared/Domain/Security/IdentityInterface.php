<?php


namespace App\Shared\Domain\Security;


use App\Auth\Domain\UserEmail;

interface IdentityInterface
{
    public function email(): UserEmail;
}