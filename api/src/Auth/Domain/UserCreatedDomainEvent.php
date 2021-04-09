<?php


namespace App\Auth\Domain;


use App\Shared\Domain\Bus\Event\DomainEvent;

final class UserCreatedDomainEvent extends DomainEvent
{
    private string $email;

    public function __construct(string $id, string $email, string $eventId = null, string $occurredOn = null)
    {
        $this->email = $email;
        parent::__construct($id, $eventId, $occurredOn);
    }

    public function fromPrimitives(string $aggregateId, array $body, string $eventId, string $occurredOn): DomainEvent
    {
        return new self($aggregateId, $body['email'], $eventId, $occurredOn);
    }

    public function toPrimitives(): array
    {
        return [
            'email' => $this->email
        ];
    }

    public function eventName(): string
    {
        return 'user.created';
    }

    public function email(): string
    {
        return $this->email;
    }
}