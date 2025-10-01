<?php

declare(strict_types=1);

namespace App\User\Application\Dto;

final readonly class UserRegistrationData
{
    public function __construct(
        public string $email,
        public string $plainPassword,
        /** @var array<int|string> $roles */
        public array $roles,
        public string $firstname,
        public string $lastname,
        public ?string $phone,
    ) {
    }
}
