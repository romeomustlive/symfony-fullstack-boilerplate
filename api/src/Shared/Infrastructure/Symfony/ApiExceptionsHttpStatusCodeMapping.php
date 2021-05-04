<?php


namespace App\Shared\Infrastructure\Symfony;


use App\Shared\Infrastructure\Bus\ValidationError;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use function Lambdish\Phunctional\get;

final class ApiExceptionsHttpStatusCodeMapping
{
    private const DEFAULT_STATUS_CODE = Response::HTTP_INTERNAL_SERVER_ERROR;
    private array $exceptions = [
        InvalidArgumentException::class => Response::HTTP_BAD_REQUEST,
        NotFoundHttpException::class => Response::HTTP_NOT_FOUND,
        ValidationError::class => Response::HTTP_UNPROCESSABLE_ENTITY
    ];

    public function register(string $exceptionClass, int $statusCode): void
    {
        $this->exceptions[$exceptionClass] = $statusCode;
    }

    public function statusCodeFor(string $exceptionClass): int
    {
        $statusCode = get($exceptionClass, $this->exceptions, self::DEFAULT_STATUS_CODE);

        if (null === $statusCode) {
            throw new InvalidArgumentException(
                sprintf('There are no status code mapping for %s', $exceptionClass)
            );
        }

        return $statusCode;
    }
}