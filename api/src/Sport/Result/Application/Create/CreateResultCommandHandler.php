<?php


namespace App\Sport\Result\Application\Create;


use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Sport\Exercise\Domain\ExerciseId;
use App\Sport\Result\Domain\ResultCount;
use App\Sport\Result\Domain\ResultId;
use App\Sport\Result\Domain\ResultUserId;
use App\Sport\Result\Domain\ResultWeight;
use DateTimeImmutable;

final class CreateResultCommandHandler implements CommandHandler
{
    private ResultCreator $creator;

    public function __construct(ResultCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateResultCommand $command)
    {
        $id = new ResultId($command->id());
        $weight = new ResultWeight($command->weight());
        $count = new ResultCount($command->count());
        $userId = new ResultUserId($command->userId());
        $exercise = new ExerciseId($command->exerciseId());
        $createdAt = new DateTimeImmutable();

        $this->creator->create($id, $weight, $count, $userId, $exerciseId, $createdAt);
    }
}