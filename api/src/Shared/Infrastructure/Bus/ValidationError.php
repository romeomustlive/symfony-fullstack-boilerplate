<?php


namespace App\Shared\Infrastructure\Bus;


use LogicException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Throwable;

final class ValidationError extends LogicException
{
    private ConstraintViolationListInterface $violations;

    public function __construct(ConstraintViolationListInterface $violations, $message = "", $code = 0, Throwable $previous = null)
    {
        $this->violations = $violations;
        parent::__construct($message, $code, $previous);
    }

    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}