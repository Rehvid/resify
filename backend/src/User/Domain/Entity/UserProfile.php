<?php

declare(strict_types=1);

namespace App\User\Domain\Entity;

use App\Patient\Domain\Entity\Patient;
use App\Shared\Domain\Contracts\IdentifiableEntityInterface;
use App\Shared\Domain\Contracts\TimestampableInterface;
use App\Shared\Domain\Traits\TimestampableTrait;
use App\Shared\Domain\ValueObject\Doctrine\Timestamps\CreatedAt;
use App\Shared\Domain\ValueObject\Doctrine\Timestamps\UpdatedAt;
use App\User\Infrastructure\Repository\Doctrine\UserProfileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserProfileRepository::class)]
class UserProfile implements IdentifiableEntityInterface, TimestampableInterface
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\OneToOne(targetEntity: User::class, inversedBy: 'profile', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private User $user;

    #[ORM\OneToOne(targetEntity: Patient::class, mappedBy: 'userProfile', cascade: ['persist', 'remove'])]
    private ?Patient $patient = null;

    #[ORM\Column(length: 255)]
    private string $firstname;

    #[ORM\Column(length: 255)]
    private string $lastname;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $phone;

    #[ORM\Embedded(class: CreatedAt::class, columnPrefix: false)]
    private CreatedAt $createdAt;

    #[ORM\Embedded(class: UpdatedAt::class, columnPrefix: false)]
    private UpdatedAt $updatedAt;

    public function __construct(User $user, string $firstname, string $lastname, ?string $phone = null)
    {
        $this->user = $user;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->phone = $phone;

        $this->createdAt = new CreatedAt();
        $this->markAsUpdated();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
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
