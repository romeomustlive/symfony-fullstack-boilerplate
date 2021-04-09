<?php


namespace App\Shared\Infrastructure\Bus\Query;

use App\Shared\Domain\Bus\Query\Query;
use RuntimeException;
use Throwable;

final class QueryNotRegisteredError extends RuntimeException
{
    public function __construct(Query $query)
    {
        $queryClass = get_class($query);
        parent::__construct(sprintf('The query %s has not command handler associated.', $query));
    }
}