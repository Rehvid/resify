<?php

declare(strict_types=1);

namespace App\User\Domain\Repository;

use App\Shared\Application\Repository\ReadRepositoryInterface;
use App\Shared\Application\Repository\WriteRepositoryInterface;
use App\User\Domain\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @extends ReadRepositoryInterface<User>
 * @extends WriteRepositoryInterface<User>
 */
interface UserRepositoryInterface extends ReadRepositoryInterface, WriteRepositoryInterface
{
    public function loadUserByIdentifier(string $identifier): ?UserInterface;

    public function findOneByEmail(string $email): ?User;
}
