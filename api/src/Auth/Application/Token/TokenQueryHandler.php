<?php


namespace App\Auth\Application\Token;


use App\Shared\Domain\Bus\Query\QueryHandler;

final class TokenQueryHandler implements QueryHandler
{
    private TokenCreator $tokenCreator;

    public function __construct(TokenCreator $tokenCreator)
    {
        $this->tokenCreator = $tokenCreator;
    }

    public function __invoke(TokenQuery $query): TokenResponse
    {
        $token = $this->tokenCreator->create($query->email());

        return new TokenResponse($token);
    }
}