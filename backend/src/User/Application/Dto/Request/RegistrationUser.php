<?php

declare(strict_types=1);

namespace App\User\Application\Dto\Request;

use App\User\Infrastructure\Validator\UniqueUserEmailField;
use App\User\Infrastructure\Validator\StrongPassword;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

final readonly class RegistrationUser
{
    #[Assert\NotBlank]
    #[Assert\Email]
    #[UniqueUserEmailField]
    public string $email;

    #[Assert\NotBlank]
    #[StrongPassword]
    public string $password;

    #[Assert\NotBlank]
    public string $passwordConfirmation;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    public string $firstname;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    public string $lastname;

    #[Assert\When(
        expression: 'this.phone !== null',
        constraints: [
            new Assert\Regex(
                pattern: "/^\+?[0-9]{7,15}$/",
                message: "The phone number may optionally start with '+' and must contain between 7 and 15 digits."
            ),
        ]
    )]
    public ?string $phone;

    public function __construct(
        string $email,
        string $password,
        string $passwordConfirmation,
        string $firstname,
        string $lastname,
        ?string $phone = null
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->passwordConfirmation = $passwordConfirmation;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->phone = $phone;
    }

    #[Assert\Callback]
    public function validatePasswords(ExecutionContextInterface $context): void
    {
        if ($this->password !== $this->passwordConfirmation) {
            $context->buildViolation('Passwords do not match.')
                ->atPath('passwordConfirmation')
                ->addViolation();
        }
    }
}
