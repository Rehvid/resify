<?php

declare(strict_types=1);

namespace App\Shared\Application\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class RequestValidationException extends HttpException
{
    public function __construct(
        public readonly ConstraintViolationListInterface $violationList,
        int $statusCode = Response::HTTP_BAD_REQUEST
    ) {
        parent::__construct($statusCode);
    }
}
