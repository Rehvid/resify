<?php

declare(strict_types=1);

namespace App\Patient\Application\Command\Register;

use App\Patient\Domain\Entity\Patient;
use App\Patient\Domain\Repository\PatientRepositoryInterface;
use App\User\Application\Dto\UserRegistrationData;
use App\User\Application\Factory\UserAggregateFactory;
use App\User\Domain\Enums\UserRole;
use App\User\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'command.bus')]
final readonly class RegisterPatientHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private PatientRepositoryInterface $patientRepository,
        private UserAggregateFactory $userAggregateFactory,
    ) {
    }

    public function __invoke(RegisterPatientCommand $command): void
    {
        $profile = $this->userAggregateFactory->create(new UserRegistrationData(
            $command->email,
            $command->password,
            [UserRole::ROLE_PATIENT->value],
            $command->firstname,
            $command->lastname,
            $command->phone
        ));

        $patient = new Patient(
            $profile,
            $command->birthDate
        );

        $this->userRepository->save($profile->getUser());
        $this->patientRepository->save($patient);
    }
}
