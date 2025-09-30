<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Repository\Doctrine;

use App\Shared\Infrastructure\Repository\Doctrine\AbstractRepository;
use App\User\Domain\Entity\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @extends AbstractRepository<User>
 */
final class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function loadUserByIdentifier(string $identifier): ?UserInterface
    {
        /** @var UserInterface|null $entity */
        $entity = $this->findOneBy(['email' => $identifier]);

        return $entity;
    }

    public function findOneByEmail(string $email): ?User
    {
        return $this->findOneBy(['email' => $email]);
    }

    protected function getEntityClass(): string
    {
        return User::class;
    }

    protected function getAlias(): string
    {
        return 'user';
    }
}
