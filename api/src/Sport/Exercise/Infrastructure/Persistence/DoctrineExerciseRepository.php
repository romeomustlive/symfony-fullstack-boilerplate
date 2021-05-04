<?php


namespace App\Sport\Exercise\Infrastructure\Persistence;


use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineCriteriaConverter;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\Sport\Exercise\Domain\Exercise;
use App\Sport\Exercise\Domain\ExerciseId;
use App\Sport\Exercise\Domain\ExerciseRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

final class DoctrineExerciseRepository extends DoctrineRepository implements ExerciseRepository
{
    public function save(Exercise $exercise): void
    {
        $this->persist($exercise);
    }

    public function search(ExerciseId $id): ?Exercise
    {
        /** @var Exercise|null $exercise */
        $exercise = $this->repository(Exercise::class)->find($id);

        return $exercise;
    }

    public function delete(Exercise $exercise): void
    {
        // TODO: Implement delete() method.
    }

    public function matching(Criteria $criteria): array
    {
        $doctrineCriteria = DoctrineCriteriaConverter::convert($criteria);
        $qb = $this->entityManager()->createQueryBuilder()
            ->select('e')
            ->from(Exercise::class, 'e')
            ->addCriteria($doctrineCriteria)
            ->getQuery();

        return $this->preparePaginatedData($qb, $criteria);
    }

    private function preparePaginatedData(Query $query, Criteria $criteria): array
    {
        $paginator = new Paginator($query);
        $totalItems = count($paginator);
        $pagesCount = ceil($totalItems / $criteria->pageSize());

        $paginator
            ->getQuery()
            ->setFirstResult(($criteria->page() - 1) * $criteria->pageSize())
            ->setMaxResults($criteria->pageSize());

        $items = iterator_to_array($paginator->getIterator());

        return [$items, $pagesCount, $totalItems];
    }
}