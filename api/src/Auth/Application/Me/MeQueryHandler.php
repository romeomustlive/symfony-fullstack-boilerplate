<?php


namespace App\Auth\Application\Me;


use App\Shared\Domain\Bus\Query\QueryHandler;

final class MeQueryHandler implements QueryHandler
{
    private MeFinder $finder;

    public function __construct(MeFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(MeQuery $query): MeResponse
    {
        $user = $this->finder->find();

        return new MeResponse($user->id()->value(), $user->email()->value());
    }
}