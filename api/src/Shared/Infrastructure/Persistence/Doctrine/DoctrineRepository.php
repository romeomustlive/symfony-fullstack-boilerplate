<?php


namespace App\Shared\Infrastructure\Persistence\Doctrine;


use App\Shared\Domain\Aggregate\AggregateRoot;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

abstract class DoctrineRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function entityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    protected function persist(AggregateRoot $entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    protected function remove(AggregateRoot $entity)
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    protected function repository(string $className): ObjectRepository
    {
        return $this->entityManager()->getRepository($className);
    }
}