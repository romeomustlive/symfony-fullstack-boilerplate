<?php


namespace App\Auth\Application\Me;


use App\Auth\Domain\User;
use App\Auth\Domain\UserEmail;
use App\Auth\Domain\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use RuntimeException;

final class MeFinder
{
    private JWTEncoderInterface $encoder;
    private UserRepository $repository;

    public function __construct(JWTEncoderInterface $encoder, UserRepository $repository)
    {
        $this->encoder = $encoder;
        $this->repository = $repository;
    }

    public function find(): User
    {
        $token = $this->extractTokenFromHeaders();

        $emailString = $this->extractEmailFromToken($token);

        $user = $this->repository->search(new UserEmail($emailString));

        $this->ensureUserExist($user);

        return $user;
    }

    private function extractTokenFromHeaders(): string
    {
        $token = explode(" ", getallheaders()['Authorization'])[1];

        if (null === $token) {
            throw new RuntimeException('Authorization header empty.');
        }

        return $token;
    }

    private function extractEmailFromToken(string $token): string
    {
        try {
            $email = $this->encoder->decode($token)['username'];
        } catch (JWTDecodeFailureException $e) {
            throw new RuntimeException('Token invalid or expired.');
        }

        return $email;
    }

    private function ensureUserExist(?User $user)
    {
        if (null === $user) {
            throw new RuntimeException('User token wrong or expired.');
        }
    }
}