<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class UniqueUserEmailField extends Constraint
{
    public string $message = 'This email is already used.';
}
