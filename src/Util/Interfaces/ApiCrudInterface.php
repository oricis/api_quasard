<?php

declare(strict_types=1);

namespace App\Util\Interfaces;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

interface ApiCrudInterface
{

    public function create(Request $request): JsonResponse;
    public function delete(int $id): JsonResponse;
    public function find(int $id): JsonResponse;
    public function update(Request $request): JsonResponse;
}
