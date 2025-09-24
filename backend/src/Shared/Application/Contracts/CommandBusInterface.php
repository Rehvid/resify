<?php

declare(strict_types=1);

namespace App\Shared\Application\Contracts;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}
