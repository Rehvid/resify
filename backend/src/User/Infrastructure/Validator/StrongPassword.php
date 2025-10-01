<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class StrongPassword extends Constraint
{
    public string $message = 'The password must contain at least 12 characters, including lowercase and uppercase letters, a digit, and at least one special character';
}
