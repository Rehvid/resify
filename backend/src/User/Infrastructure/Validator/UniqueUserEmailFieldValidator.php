<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Validator;

use App\Shared\Domain\Contracts\IdentifiableEntityInterface;
use App\User\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UniqueUserEmailFieldValidator extends ConstraintValidator
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof UniqueUserEmailField) {
            throw new UnexpectedTypeException($constraint, UniqueUserEmailField::class);
        }

        if ('' === $value || !is_string($value)) {
            return;
        }

        $object = $this->context->getObject();

        /** @param string $value */
        $entity = $this->userRepository->findOneByEmail($value);

        if (
            $entity instanceof IdentifiableEntityInterface
            && $object instanceof IdentifiableEntityInterface
            && $entity->getId() === $object->getId()
        ) {
            return;
        }

        if ($entity) {
            $this->context
                ->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
