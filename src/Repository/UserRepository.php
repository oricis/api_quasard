<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exceptions\UpdateEntityException;
use App\Repository\Traits\UserNotesTrait;
use App\Service\Repository\User\CreateUserService;
use App\Service\Repository\User\DeleteUserService;
use App\Service\Repository\User\UpdateUserService;
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
        $data = [
            'name' => $request->request->get('name'),
            'email' => $request->request->get('email', null),
            'active' => $request->request->get('active', 1),
        ];

        return (new CreateUserService($this->connection))->create($data);
    }

    public function update(Request $request): int
    {
        try {
            $id = $request->request->get('id');
            if (is_null($id)) {
                $message = 'Lost entity ID from update request';
                throw new UpdateEntityException($message);
            }
        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return 0;
        }

        $data = [
            'id'   => (int) $id,
            'name' => $request->request->get('name'),
            'email' => $request->request->get('email', null),
            'active' => $request->request->get('active', 1),
        ];

        return (new UpdateUserService($this->connection))->update($data);
    }

    public function delete(int $id): bool
    {
        return (new DeleteUserService($this->connection))->delete($id);
    }
}
