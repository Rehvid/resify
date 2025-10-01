<?php

declare(strict_types=1);

namespace App\Patient\Application\Dto\Request;

use App\User\Application\Contract\RoleRegistrationUserInterface;
use App\User\Application\Dto\Request\RegistrationUser;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class PatientRegistrationUser implements RoleRegistrationUserInterface
{
    #[Assert\Valid]
    public RegistrationUser $user;

    //TODO: Add custom constraint in the future
    public ?\DateTimeImmutable $birthday;

    private function __construct(RegistrationUser $user, ?\DateTimeImmutable $birthday = null)
    {
        $this->user = $user;
        $this->birthday = $birthday;
    }

    /** @param array<string, string> $data */
    public static function hydrate(array $data): self
    {
        $registrationUser = new RegistrationUser(
            $data['email'] ?? '',
            $data['password'] ?? '',
            $data['passwordConfirmation'] ?? '',
            $data['firstname'] ?? '',
            $data['lastname'] ?? '',
            $data['phone'] ?? '',
        );

        return new self($registrationUser, $data['birthday']);
    }
}
