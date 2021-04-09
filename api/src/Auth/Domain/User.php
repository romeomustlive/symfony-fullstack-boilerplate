<?php


namespace App\Auth\Domain;


use App\Shared\Domain\Aggregate\AggregateRoot;

final class User extends AggregateRoot
{
    private UserId $id;
    private UserEmail $email;
    private UserPassword $password;

    public function __construct(UserId $id, UserEmail $email, UserPassword $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    public static function create(UserId $id, UserEmail $email, UserPassword $password): self
    {
        $user = new self($id, $email, $password);

        $user->record(new UserCreatedDomainEvent($id, $email));

        return $user;
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password->value());
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }
}