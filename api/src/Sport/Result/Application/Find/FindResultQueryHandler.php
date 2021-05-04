<?php


namespace App\Sport\Result\Application\Find;


use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\Bus\Query\Response;
use App\Shared\Domain\Utils;
use App\Sport\Result\Application\ResultResponse;
use App\Sport\Result\Domain\ResultId;

final class FindResultQueryHandler implements QueryHandler
{
    private ResultFinder $finder;

    public function __construct(ResultFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(FindResultQuery $query): Response
    {
        $id = new ResultId($query->id());

        $result = $this->finder->find($id);

        return new ResultResponse(
            $result->id()->value(),
            $result->weight()->value(),
            $result->count()->value(),
            Utils::dateToString($result->createdAt()),
            $result->exercise()->title()->value()
        );
    }
}