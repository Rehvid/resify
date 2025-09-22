<?php

declare(strict_types=1);

namespace App\Shared\Application\Repository;

/**
 * @template T of object
 */
interface WriteRepositoryInterface
{
    /** @param T $entity */
    public function save(object $entity): void;

    /** @param T $entity */
    public function remove(object $entity): void;

    /** @param T[] $entities */
    public function removeCollection(array $entities): void;
}
