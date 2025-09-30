<?php

declare(strict_types=1);

namespace App\Patient\Domain\Entity;

use App\Patient\Infrastructure\Repository\Doctrine\PatientRepository;
use App\Shared\Domain\Contracts\IdentifiableEntityInterface;
use App\Shared\Domain\Contracts\TimestampableInterface;
use App\Shared\Domain\Traits\TimestampableTrait;
use App\Shared\Domain\ValueObject\Doctrine\Timestamps\CreatedAt;
use App\Shared\Domain\ValueObject\Doctrine\Timestamps\UpdatedAt;
use App\User\Domain\Entity\UserProfile;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Patient implements IdentifiableEntityInterface, TimestampableInterface
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\OneToOne(targetEntity: UserProfile::class, inversedBy: 'patient', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private UserProfile $userProfile;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $birthday;

    #[ORM\Embedded(class: CreatedAt::class, columnPrefix: false)]
    private CreatedAt $createdAt;

    #[ORM\Embedded(class: UpdatedAt::class, columnPrefix: false)]
    private UpdatedAt $updatedAt;

    public function __construct(UserProfile $userProfile, ?\DateTimeImmutable $birthday = null)
    {
        $this->userProfile = $userProfile;
        $this->birthday = $birthday;

        $this->createdAt = new CreatedAt();
        $this->markAsUpdated();
    }

    public function changeBirthday(?\DateTimeImmutable $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserProfile(): UserProfile
    {
        return $this->userProfile;
    }

    public function getBirthday(): ?\DateTimeImmutable
    {
        return $this->birthday;
    }

    public function getCreatedAt(): CreatedAt
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): UpdatedAt
    {
        return $this->updatedAt;
    }
}
