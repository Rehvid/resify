<?php

declare(strict_types=1);

namespace App\Shared\Application\Contracts;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

#[AutoconfigureTag('app.exception_handler')]
interface ExceptionHandlerInterface
{
    public function supports(\Throwable $throwable): bool;

    public function handle(ExceptionEvent $event, \Throwable $throwable): void;
}
