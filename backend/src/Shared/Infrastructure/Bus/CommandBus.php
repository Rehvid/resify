<?php

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Application\Contracts\CommandBusInterface;
use App\Shared\Application\Contracts\CommandInterface;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class CommandBus implements CommandBusInterface
{
    public function __construct(
        private MessageBusInterface $messageBus
    ) {
    }

    /**
     * @throws ExceptionInterface
     */
    public function dispatch(CommandInterface $command): void
    {
        $this->messageBus->dispatch($command);
    }
}
