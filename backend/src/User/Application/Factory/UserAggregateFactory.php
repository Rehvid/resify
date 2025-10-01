<?php

declare(strict_types=1);

namespace App\User\Application\Factory;

use App\User\Application\Dto\UserRegistrationData;
use App\User\Domain\Entity\UserProfile;

final readonly class UserAggregateFactory
{
    public function __construct(
        private UserFactory $userFactory,
    ) {
    }

    public function create(UserRegistrationData $data): UserProfile
    {
        $user = $this->userFactory->create($data->email, $data->plainPassword, $data->roles);

        return new UserProfile(
            $user,
            $data->firstname,
            $data->lastname,
            $data->phone
        );
    }
}
