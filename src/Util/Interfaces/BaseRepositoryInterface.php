<?php

declare(strict_types=1);

namespace App\Util\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface BaseRepositoryInterface
{

    public function create(Request $request): int;
    public function delete(int $id, Request $request): bool;
    public function find(int $id):? object;
    public function update(Request $request): int;
}
