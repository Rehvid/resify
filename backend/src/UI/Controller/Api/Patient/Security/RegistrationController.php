<?php

declare(strict_types=1);

namespace App\UI\Controller\Api\Patient\Security;

use App\Patient\Application\Command\Register\RegisterPatientCommand;
use App\Patient\Application\Dto\Request\PatientRegistrationUser;
use App\Shared\Application\Contracts\CommandBusInterface;
use App\Shared\Application\Dto\Response\ApiResponse;
use App\User\Infrastructure\Resolver\RoleRegistrationUserResolver;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class RegistrationController extends AbstractController
{
    #[Route(path: '/register', name: 'register', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload(resolver: RoleRegistrationUserResolver::class)] PatientRegistrationUser $request,
        CommandBusInterface $bus
    ): JsonResponse {
        $bus->dispatch(new RegisterPatientCommand(
            $request->user->email,
            $request->user->password,
            $request->user->firstname,
            $request->user->lastname,
            $request->user->phone,
            $request->birthday
        ));

        return new ApiResponse()->success();
    }
}
