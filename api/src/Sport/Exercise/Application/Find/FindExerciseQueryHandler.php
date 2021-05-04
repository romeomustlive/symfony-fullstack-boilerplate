<?php


namespace App\Sport\Exercise\Application\Find;


use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\Bus\Query\Response;
use App\Sport\Exercise\Domain\ExerciseId;

final class FindExerciseQueryHandler implements QueryHandler
{
    private ExerciseFinder $finder;

    public function __construct(ExerciseFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(FindExerciseQuery $query): Response
    {
        $id = new ExerciseId($query->id());

        $exercise = $this->finder->find($id);

        return new ExerciseResponse(
            $exercise->id()->value(),
            $exercise->title()->value(),
            $exercise->description()->value(),
            $exercise->userId()->value()
        );
    }
}