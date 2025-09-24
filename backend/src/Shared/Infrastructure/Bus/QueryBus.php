<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Application\Contracts\QueryBusInterface;
use App\Shared\Application\Contracts\QueryInterface;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final readonly class QueryBus implements QueryBusInterface
{
    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    /**
     * @throws ExceptionInterface
     */
    public function ask(QueryInterface $query): mixed
    {
        $envelope = $this->messageBus->dispatch($query);
        $stamp = $envelope->last(HandledStamp::class);

        if (!$stamp) {
            throw new \RuntimeException('Not found handler for query');
        }

        return $stamp->getResult();
    }
}
