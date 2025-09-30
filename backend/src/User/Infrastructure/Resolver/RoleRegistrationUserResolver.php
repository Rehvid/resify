<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Resolver;

use App\Shared\Application\Exception\RequestValidationException;
use App\User\Application\Contract\RoleRegistrationUserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final readonly class RoleRegistrationUserResolver implements ValueResolverInterface
{
    public function __construct(
        private ValidatorInterface $validator
    ) {
    }

    /** @return array<int, mixed> */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $attribute = $argument->getAttributesOfType(MapRequestPayload::class, ArgumentMetadata::IS_INSTANCEOF)[0] ?? null;
        if (!$attribute) {
            return [];
        }

        $data = json_decode($request->getContent(), true);
        if (empty($data)) {
            return [];
        }

        $class = $argument->getType() ?? '';
        if (!class_exists($class) || !in_array(RoleRegistrationUserInterface::class, class_implements($class), true)) {
            throw new \InvalidArgumentException('Invalid class');
        }

        /** @var RoleRegistrationUserInterface $dto */
        $dto = $class::hydrate($data);

        $violationList = $this->validator->validate($dto);
        if (count($violationList) > 0) {
            throw new RequestValidationException($violationList, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return [$dto];
    }
}
