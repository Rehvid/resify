<?php

declare(strict_types=1);

namespace App\Shared\Application\Repository;

/**
 * @template T of object
 */
interface ReadRepositoryInterface
{
    /** @return T[] */
    public function findAll(): array;

    /** @return T|null */
    public function findById(string|int|null $id): ?object;
}
