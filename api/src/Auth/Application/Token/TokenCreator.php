<?php


namespace App\Auth\Application\Token;


use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;

final class TokenCreator
{
    private JWTEncoderInterface $encoder;
    private int $expired;

    public function __construct(JWTEncoderInterface $encoder, int $expired)
    {
        $this->encoder = $encoder;
        $this->expired = $expired;
    }

    public function create(string $email): string
    {
        return $this->encoder->encode([
            'username' => $email,
            'exp' => time() + $this->expired
        ]);
    }
}