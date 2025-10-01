<?php

declare(strict_types=1);

namespace App\Shared\Application\ExceptionHandler\Validation;

use App\Shared\Application\Contracts\ExceptionHandlerInterface;
use App\Shared\Application\Dto\Response\ApiResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Validator\Exception\ValidationFailedException;

final class ValidationExceptionHandler extends AbstractValidationHandler implements ExceptionHandlerInterface
{
    public function supports(\Throwable $throwable): bool
    {
        return $throwable->getPrevious() instanceof ValidationFailedException;
    }

    public function handle(ExceptionEvent $event, \Throwable $throwable): void
    {
        /** @var ValidationFailedException $exception */
        $exception = $throwable->getPrevious();

        $event->setResponse(new ApiResponse()->error(
            $this->prepareErrors($exception->getViolations()),
            Response::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}
