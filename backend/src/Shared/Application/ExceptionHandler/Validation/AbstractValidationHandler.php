<?php

declare(strict_types=1);

namespace App\Shared\Application\ExceptionHandler\Validation;

use Symfony\Component\PropertyAccess\PropertyPath;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

abstract class AbstractValidationHandler
{
    /** @return list<array<string, string|\Stringable>> */
    protected function prepareErrors(ConstraintViolationListInterface $violationList): array
    {
        $errors = [];

        foreach ($violationList as $violation) {
            $errors[] = [
                'field' => $this->getLastPathSegment($violation),
                'message' => $violation->getMessage(),
            ];
        }

        return $errors;
    }

    private function getLastPathSegment(ConstraintViolationInterface $violation): string
    {
        $path = $violation->getPropertyPath();

        if ('' === $path) {
            return $path;
        }

        $propertyPath = new PropertyPath($path);

        return $propertyPath->getElement($propertyPath->getLength() - 1);
    }
}
