<?php

declare(strict_types=1);

namespace App\Repository;

use App\Util\Interfaces\BaseRepositoryInterface;

final class CategoryRepository extends BaseRepository implements BaseRepositoryInterface
{

    public function find(int $id, bool $onlyAlive = true):? object
    {
        $query = "SELECT {$this->attributes} FROM categories
            WHERE id = {$id}";

        if ($onlyAlive) {
            $query .= ' AND deleted_at IS NULL';
        }

        $row = $this->connection
            ->executeQuery($query)
            ->fetchAssociative();

        return $row ? (object) $row : null;
    }

    public function findAll(bool $onlyAlive = true): array
    {
        $query = "SELECT {$this->attributes} FROM categories";

        if ($onlyAlive) {
            $query .= ' WHERE deleted_at IS NULL';
        }

        $rows = $this->connection
            ->executeQuery($query)
            ->fetchAllAssociative();

        return $rows ? $rows : [];
    }

    public function create():? object
    {
        return null;
    }

    public function update():? object
    {
        return null;
    }

    public function delete(int $id): bool
    {
        return false;
    }
}
