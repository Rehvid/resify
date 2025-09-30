<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Repository\Doctrine;

use App\Shared\Infrastructure\Repository\Doctrine\AbstractRepository;
use App\User\Domain\Entity\UserProfile;
use App\User\Domain\Repository\UserProfileRepositoryInterface;

/**
 * @extends AbstractRepository<UserProfile>
 */
final class UserProfileRepository extends AbstractRepository implements UserProfileRepositoryInterface
{
    protected function getEntityClass(): string
    {
        return UserProfile::class;
    }

    protected function getAlias(): string
    {
        return 'up';
    }
}
