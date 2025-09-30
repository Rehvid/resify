<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject\Doctrine\Timestamps;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
final class CreatedAt
{
    #[ORM\Column(type: 'datetime_immutable', nullable: false)]
    private \DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function value(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
