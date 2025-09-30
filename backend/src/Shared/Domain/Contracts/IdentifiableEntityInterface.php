<?php

declare(strict_types=1);

namespace App\Shared\Domain\Contracts;

interface IdentifiableEntityInterface
{
    public function getId(): string|int;
}
