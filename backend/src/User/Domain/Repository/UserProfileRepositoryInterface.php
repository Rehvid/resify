<?php

declare(strict_types=1);

namespace App\User\Domain\Repository;

use App\Shared\Application\Repository\ReadRepositoryInterface;
use App\Shared\Application\Repository\WriteRepositoryInterface;
use App\User\Domain\Entity\UserProfile;

/**
 * @extends ReadRepositoryInterface<UserProfile>
 * @extends WriteRepositoryInterface<UserProfile>
 */
interface UserProfileRepositoryInterface extends ReadRepositoryInterface, WriteRepositoryInterface
{
}
