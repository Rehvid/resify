<?php

declare(strict_types=1);

namespace App\Patient\Domain\Repository;

use App\Patient\Domain\Entity\Patient;
use App\Shared\Application\Repository\ReadRepositoryInterface;
use App\Shared\Application\Repository\WriteRepositoryInterface;

/**
 * @extends ReadRepositoryInterface<Patient>
 * @extends WriteRepositoryInterface<Patient>
 */
interface PatientRepositoryInterface extends WriteRepositoryInterface, ReadRepositoryInterface
{
}
