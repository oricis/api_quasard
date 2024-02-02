<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exceptions\CreateEntityException;
use App\Exceptions\UpdateEntityException;
use App\Repository\Traits\UserNotesTrait;
use App\Service\Repository\Note\CreateNoteService;
use App\Service\Repository\Note\DeleteNoteService;
use App\Service\Repository\Note\UpdateNoteService;
use App\Util\Interfaces\BaseRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;

final class NoteRepository extends BaseRepository implements BaseRepositoryInterface
{
    use UserNotesTrait;


    public function find(int $id, bool $onlyAlive = true):? object
    {
        $query = "SELECT {$this->attributes} FROM notes
            WHERE id = {$id}";

        if ($onlyAlive) {
            $query .= ' AND deleted_at IS NULL';
        }

        $row = $this->connection
            ->executeQuery($query)
            ->fetchAssociative();

        return $row ? (object) $row : null;
    }

    public function create(Request $request): int
    {
        try {
            $userId = (int) $request->request->get('user_id');
            if (!$this->isValidUserId($userId)) {
                $message = 'Bad entity data from create request';
                throw new CreateEntityException($message);
            }
        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return 0;
        }

        $data = [
            'categories' => $request->request->get('categories'), // f.e. '1,2,6'
            'text'    => $request->request->get('text'),
            'user_id' => $request->request->get('user_id'),
        ];

        // WARN: don't use ->create() here
        // The categories will be linked after create the note
        return (new CreateNoteService($this->connection))
            ->createNote($data);
    }

    public function update(Request $request): int
    {
        try {
            $id = $request->request->get('id');
            $userId = (int) $request->request->get('user_id');
            if (is_null($id)
                || !$this->isValidUserId($userId)) {
                $message = 'Bad entity data from update request';
                throw new UpdateEntityException($message);
            }
        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return 0;
        }

        $data = [
            'id'      => (int) $id,
            'text'    => $request->request->get('text'),
            'user_id' => $userId,
        ];

        return (new UpdateNoteService($this->connection))->update($data);
    }
    public function removeCategory(Request $request): int
    {
        $noteId = $request->request->get('note_id');
        $categoryId = $request->request->get('category_id');

        // TODO: validate IDs

        $data = [
            'note_id' => $noteId,
            'category_id' => $categoryId,
        ];

        return (new UpdateNoteService($this->connection))->removeCategory($data);
    }

    public function setCategory(Request $request): int
    {
        $noteId = $request->request->get('note_id');
        $categoryId = $request->request->get('category_id');

        // TODO: validate IDs

        $data = [
            'note_id' => $noteId,
            'category_id' => $categoryId,
        ];

        return (new UpdateNoteService($this->connection))->setCategory($data);
    }

    public function delete(int $id): bool
    {
        return (new DeleteNoteService($this->connection))->delete($id);
    }


    private function isValidUserId(int $userId): bool
    {
        $query = "SELECT id FROM users
            WHERE id = {$userId}
            AND deleted_at IS NULL";

        return (bool) $this->connection->executeQuery($query)->rowCount();
    }
}
