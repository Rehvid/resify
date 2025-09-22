<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repository\Doctrine;

use App\Shared\Application\Repository\ReadRepositoryInterface;
use App\Shared\Application\Repository\WriteRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @template T of object
 *
 * @extends ServiceEntityRepository<T>
 *
 * @implements ReadRepositoryInterface<T>
 * @implements WriteRepositoryInterface<T>
 */
abstract class AbstractRepository extends ServiceEntityRepository implements ReadRepositoryInterface, WriteRepositoryInterface
{
    /**
     * @return class-string<T>
     */
    abstract protected function getEntityClass(): string;

    abstract protected function getAlias(): string;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, $this->getEntityClass());
    }

    public function save(object $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function remove(object $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    public function removeCollection(array $entities): void
    {
        foreach ($entities as $entity) {
            $this->getEntityManager()->remove($entity);
        }

        $this->getEntityManager()->flush();
    }

    public function findById(int|string|null $id): ?object
    {
        return $id ? $this->findOneBy(['id' => $id]) : null;
    }
}
