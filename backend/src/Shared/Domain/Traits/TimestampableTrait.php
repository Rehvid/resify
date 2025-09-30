<?php

declare(strict_types=1);

namespace App\Shared\Domain\Traits;

use App\Shared\Domain\ValueObject\Doctrine\Timestamps\UpdatedAt;
use Doctrine\ORM\Mapping as ORM;

trait TimestampableTrait
{
    #[ORM\Embedded(class: UpdatedAt::class, columnPrefix: false)]
    private UpdatedAt $updatedAt;

    public function markAsUpdated(): void
    {
        $this->updatedAt = new UpdatedAt();
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt->value();
    }
}
