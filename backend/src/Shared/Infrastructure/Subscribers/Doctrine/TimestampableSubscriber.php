<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Subscribers\Doctrine;

use App\Shared\Domain\Contracts\TimestampableInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

#[AsDoctrineListener(event: Events::preUpdate, priority: 0, connection: 'default')]
class TimestampableSubscriber
{
    /**
     * @param LifecycleEventArgs<EntityManagerInterface> $args
     */
    public function preUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        $objectManager = $args->getObjectManager();
        $unitOfWork = $objectManager->getUnitOfWork();

        if ($entity instanceof TimestampableInterface) {
            $entity->markAsUpdated();
            $meta = $objectManager->getClassMetadata(get_class($entity));
            $unitOfWork->recomputeSingleEntityChangeSet($meta, $entity);
        }
    }
}
