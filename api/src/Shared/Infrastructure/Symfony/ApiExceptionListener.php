<?php


namespace App\Shared\Infrastructure\Symfony;


use App\Shared\Domain\DomainError;
use App\Shared\Domain\Utils;
use App\Shared\Infrastructure\Bus\ValidationError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Throwable;

final class ApiExceptionListener
{
    private ApiExceptionsHttpStatusCodeMapping $exceptionHandler;

    public function __construct(ApiExceptionsHttpStatusCodeMapping $exceptionHandler)
    {
        $this->exceptionHandler = $exceptionHandler;
    }

    public function onException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $event->setResponse(
            new JsonResponse(
                [
                    'code' => $this->exceptionCodeFor($exception),
                    'message' => $exception->getMessage(),
                    'errors' => $this->validationErrors($exception)
                ],
                $this->exceptionHandler->statusCodeFor(get_class($exception))
            )
        );
    }

    private function exceptionCodeFor(Throwable $error): string
    {
        $domainErrorClass = DomainError::class;

        /** @var DomainError $error */
        return $error instanceof $domainErrorClass
            ? $error->errorCode()
            : Utils::toSnakeCase(Utils::extractClassName($error));
    }

    /**
     * @param Throwable $error
     * @return string|array
     */
    private function validationErrors(Throwable $error)
    {
        $validationErrorClass = ValidationError::class;

        /** @var ValidationError $error */
        return $error instanceof $validationErrorClass
            ? $this->extractErrorsList($error)
            : '';
    }

    private function extractErrorsList(ValidationError $error): array
    {
        $errorsList = [];

        /** @var ConstraintViolationInterface $violation */
        foreach ($error->getViolations() as $violation) {
            $errorsList[$violation->getPropertyPath()] = $violation->getMessage();
        }

        return $errorsList;
    }
}