<?php

declare(strict_types=1);

namespace App\Patient\Infrastructure\Repository\Doctrine;

use App\Patient\Domain\Entity\Patient;
use App\Patient\Domain\Repository\PatientRepositoryInterface;
use App\Shared\Infrastructure\Repository\Doctrine\AbstractRepository;

/**
 * @extends AbstractRepository<Patient>
 */
final class PatientRepository extends AbstractRepository implements PatientRepositoryInterface
{
    protected function getAlias(): string
    {
        return 'p';
    }

    protected function getEntityClass(): string
    {
        return Patient::class;
    }
}
