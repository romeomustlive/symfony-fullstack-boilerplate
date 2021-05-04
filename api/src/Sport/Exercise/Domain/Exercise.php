<?php


namespace App\Sport\Exercise\Domain;


use App\Shared\Domain\Aggregate\AggregateRoot;

final class Exercise extends AggregateRoot
{
    private ExerciseId $id;
    private ExerciseTitle $title;
    private ?ExerciseDescription $description;
    private ExerciseUserId $userId;

    public function __construct(
        ExerciseId $id,
        ExerciseTitle $title,
        ?ExerciseDescription $description,
        ExerciseUserId $userId
    ){
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->userId = $userId;
    }

    public static function create(
        ExerciseId $id,
        ExerciseTitle $title,
        ?ExerciseDescription $description,
        ExerciseUserId $userId
    ): self {
        $exercise = new self(
            $id,
            $title,
            $description,
            $userId
        );

        return $exercise;
    }

    public function rename(ExerciseTitle $title)
    {
        $this->title = $title;
    }

    public function changeDescription(ExerciseDescription $description)
    {
        $this->description = $description;
    }

    public function id(): ExerciseId
    {
        return $this->id;
    }

    public function title(): ExerciseTitle
    {
        return $this->title;
    }

    public function description(): ?ExerciseDescription
    {
        return $this->description;
    }

    public function userId(): ExerciseUserId
    {
        return $this->userId;
    }
}