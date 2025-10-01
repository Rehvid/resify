<?php

declare(strict_types=1);

namespace App\Shared\Application\ExceptionHandler\Validation;

use App\Shared\Application\Contracts\ExceptionHandlerInterface;
use App\Shared\Application\Dto\Response\ApiResponse;
use App\Shared\Application\Exception\RequestValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final class RequestValidationHandler extends AbstractValidationHandler implements ExceptionHandlerInterface
{
    public function supports(\Throwable $throwable): bool
    {
        return $throwable instanceof RequestValidationException;
    }

    /** @param RequestValidationException $throwable */
    public function handle(ExceptionEvent $event, \Throwable $throwable): void
    {
        $event->setResponse(new ApiResponse()->error(
            $this->prepareErrors($throwable->violationList),
            Response::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}
