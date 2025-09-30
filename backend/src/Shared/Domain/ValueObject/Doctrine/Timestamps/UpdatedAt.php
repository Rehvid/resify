<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject\Doctrine\Timestamps;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
final class UpdatedAt
{
    #[ORM\Column(type: 'datetime_immutable', nullable: false)]
    private \DateTimeImmutable $updatedAt;

    public function __construct()
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function value(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
