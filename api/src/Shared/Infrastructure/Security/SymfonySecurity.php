<?php


namespace App\Shared\Infrastructure\Security;


use App\Account\User\Application\Find\FindUserQuery;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\Security\Security;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;


final class SymfonySecurity implements Security
{
    private JWTEncoderInterface $encoder;

    public function __construct(JWTEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function user()
    {
        $token = $this->extractTokenFromHeader();

        $email = $this->encoder->decode($token)['username'];
    }

    private function extractTokenFromHeader(): string
    {
        return explode(' ', getallheaders()['Authorization'])[1];
    }

}