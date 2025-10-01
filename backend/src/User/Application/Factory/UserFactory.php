<?php

declare(strict_types=1);

namespace App\User\Application\Factory;

use App\User\Domain\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final readonly class UserFactory
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    /**
     * @param array<int|string> $roles
     */
    public function create(string $email, string $plainPassword, array $roles): User
    {
        $tmpUser = new User('tmp', 'tmp', []);
        $hashedPassword = $this->passwordHasher->hashPassword($tmpUser, $plainPassword);

        return new User($email, $hashedPassword, $roles);
    }
}
