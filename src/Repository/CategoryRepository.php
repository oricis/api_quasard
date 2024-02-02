<?php

declare(strict_types=1);

namespace App\Repository;

use App\Services\Categories\CreateCategoryService;
use App\Util\Interfaces\BaseRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;

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

    public function create(Request $request): int
    {
        $data = [
            'name' => $request->request->get('name'),
            'description' => $request->request->get('description', null),
            'active' => $request->request->get('active', 1),
        ];

        return (new CreateCategoryService($this->connection))->create($data);
    }

    public function update(Request $request): int
    {
        return null;
    }

    public function delete(int $id, Request $request): bool
    {
        return false;
    }
}
