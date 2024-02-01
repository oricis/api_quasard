<?php

declare(strict_types=1);

namespace App\Util\Interfaces;

interface BaseRepositoryInterface
{

    public function create():? object;
    public function delete(int $id): bool;
    public function find(int $id):? object;
    public function update():? object;
}
