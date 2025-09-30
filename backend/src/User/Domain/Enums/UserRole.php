<?php

declare(strict_types=1);

namespace App\User\Domain\Enums;

enum UserRole: string
{
    case ROLE_PATIENT = 'ROLE_PATIENT';
    case ROLE_DOCTOR = 'ROLE_DOCTOR';
    case ROLE_ADMIN = 'ROLE_ADMIN';
}
