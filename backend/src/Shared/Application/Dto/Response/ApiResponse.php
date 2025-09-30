<?php

declare(strict_types=1);

namespace App\Shared\Application\Dto\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final readonly class ApiResponse
{
    /** @param array<mixed, mixed> $meta */
    public function success(mixed $data = null, array $meta = []): JsonResponse
    {
        return new JsonResponse([
            'status' => 'success',
            'data' => $data,
            'meta' => $meta,
            'errors' => [],
        ]);
    }

    /** @param list<array<string, string|\Stringable>> $errors */
    public function error(array $errors, int $statusCode = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return new JsonResponse([
            'status' => 'error',
            'data' => null,
            'meta' => [],
            'errors' => $errors,
        ], $statusCode);
    }
}
