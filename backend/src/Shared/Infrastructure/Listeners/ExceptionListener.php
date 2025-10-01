<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Listeners;

use App\Shared\Application\Contracts\ExceptionHandlerInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

#[AsEventListener]
final readonly class ExceptionListener
{
    /**
     * @param iterable<ExceptionHandlerInterface> $handlers
     */
    public function __construct(
        #[TaggedIterator('app.exception_handler')]
        private iterable $handlers
    ) {
    }

    public function __invoke(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();

        foreach ($this->handlers as $handler) {
            if ($handler->supports($throwable)) {
                $handler->handle($event, $throwable);

                return;
            }
        }
    }
}
