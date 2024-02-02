<?php

declare(strict_types=1);

namespace App\Repository;

use App\Repository\Traits\UserNotesTrait;

use App\Util\Interfaces\BaseRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;

final class UserRepository extends BaseRepository implements BaseRepositoryInterface
{
    use UserNotesTrait;


    public function find(int $id, bool $onlyAlive = true):? object
    {
        $query = "SELECT {$this->attributes} FROM users
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
        $query = "SELECT {$this->attributes} FROM users";

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
        return 0;
    }

    public function update(Request $request): int
    {
        return 0;
    }

    public function delete(int $id): bool
    {
        return false;
    }
}
