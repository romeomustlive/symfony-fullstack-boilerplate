<?php


namespace App\Shared\Infrastructure\Bus;


use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class ValidationMiddleware implements MiddlewareInterface
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        $errors = $this->validator->validate($envelope->getMessage());

        if (count($errors) > 0) {
            throw new ValidationError($errors);
        }

        return $stack->next()->handle($envelope, $stack);
    }
}