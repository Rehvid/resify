<?php

declare(strict_types=1);

namespace App\User\Domain\Entity;

use App\Shared\Domain\Contracts\IdentifiableEntityInterface;
use App\Shared\Domain\Contracts\TimestampableInterface;
use App\Shared\Domain\Traits\TimestampableTrait;
use App\Shared\Domain\ValueObject\Doctrine\Timestamps\CreatedAt;
use App\Shared\Domain\ValueObject\Doctrine\Timestamps\UpdatedAt;
use App\User\Infrastructure\Repository\Doctrine\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'users')]
class User implements UserInterface, PasswordAuthenticatedUserInterface, IdentifiableEntityInterface, TimestampableInterface
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private string $id;

    #[ORM\Column(length: 255, unique: true)]
    private string $email;

    #[ORM\Column(length: 255)]
    private string $password;

    /** @var array<int|string> */
    #[ORM\Column(type: 'json')]
    private array $roles;

    #[ORM\OneToOne(targetEntity: UserProfile::class, mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?UserProfile $profile = null;

    #[ORM\Embedded(class: CreatedAt::class, columnPrefix: false)]
    private CreatedAt $createdAt;

    /** @param array<int|string> $roles */
    public function __construct(string $email, string $hashedPassword, array $roles)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->email = $email;
        $this->password = $hashedPassword;
        $this->roles = $roles;

        $this->createdAt = new CreatedAt();
        $this->markAsUpdated();
    }

    public function changeEmail(string $newEmail): void
    {
        $this->email = $newEmail;
    }

    public function changePassword(string $hashedPassword): void
    {
        $this->password = $hashedPassword;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /** @return array<int|string> */
    public function getRoles(): array
    {
        return $this->roles;
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        /* @phpstan-ignore-next-line */
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getProfile(): ?UserProfile
    {
        return $this->profile;
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
