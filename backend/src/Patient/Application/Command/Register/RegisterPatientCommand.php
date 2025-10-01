<?php

namespace App\Patient\Application\Command\Register;

use App\Shared\Application\Contracts\CommandInterface;

final readonly class RegisterPatientCommand implements CommandInterface
{
    public function __construct(
        public string $email,
        public string $password,
        public string $firstname,
        public string $lastname,
        public ?string $phone,
        public ?\DateTimeImmutable $birthDate,
    ) {
    }
}
