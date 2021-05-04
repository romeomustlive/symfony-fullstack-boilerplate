<?php


namespace App\Sport\Result\Domain;


use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Sport\Exercise\Domain\Exercise;
use DateTimeImmutable;

final class Result extends AggregateRoot
{
    private ResultId $id;
    private ResultWeight $weight;
    private ResultCount $count;
    private ResultUserId $userId;
    private DateTimeImmutable $createdAt;
    private Exercise $exercise;

    public function __construct(
        ResultId $id,
        ResultWeight $weight,
        ResultCount $count,
        ResultUserId $userId,
        DateTimeImmutable $createdAt,
        Exercise $exercise
    ){
        $this->id = $id;
        $this->weight = $weight;
        $this->count = $count;
        $this->userId = $userId;
        $this->createdAt = $createdAt;
        $this->exercise = $exercise;
    }

    public static function create(
        ResultId $id,
        ResultWeight $weight,
        ResultCount $count,
        ResultUserId $userId,
        DateTimeImmutable $createdAt,
        Exercise $exercise
    ): self {
        return new self(
            $id,
            $weight,
            $count,
            $userId,
            $createdAt,
            $exercise
        );
    }

    public function id(): ResultId
    {
        return $this->id;
    }

    public function weight(): ResultWeight
    {
        return $this->weight;
    }

    public function changeWeight(ResultWeight $weight): void
    {
        $this->weight = $weight;
    }

    public function count(): ResultCount
    {
        return $this->count;
    }

    public function changeCount(ResultCount $count): void
    {
      $this->count = $count;
    }

    public function userId(): ResultUserId
    {
        return $this->userId;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function exercise(): Exercise
    {
        return $this->exercise;
    }

    public function attachExercise(Exercise $exercise): void
    {
        $this->exercise = $exercise;
    }
}