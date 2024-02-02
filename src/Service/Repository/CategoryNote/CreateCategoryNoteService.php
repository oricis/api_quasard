<?php

declare(strict_types=1);

namespace App\Service\Repository\CategoryNote;

use App\Service\Repository\BaseRepositoryService;
use Doctrine\DBAL\Connection;

final class CreateCategoryNoteService extends BaseRepositoryService
{
    private Connection $connection;
    private string $table = 'category_note';


    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function create(array $data): int
    {
        try {
            $query = "INSERT INTO {$this->table}
                (note_id, category_id, created_at)
                VALUES (
                    {$data['note_id']},
                    {$data['category_id']},
                    NOW()
                )";

            return $this->connection->executeQuery($query)->rowCount();

        } catch (\Exception $e) {
            error(getExceptionStr($e));
        }

        return 0;
    }
}
