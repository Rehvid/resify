<?php

declare(strict_types=1);

namespace App\User\Application\Contract;

interface RoleRegistrationUserInterface
{
    /** @param array<string, mixed> $data */
    public static function hydrate(array $data): self;
}
