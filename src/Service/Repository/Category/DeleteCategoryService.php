<?php

declare(strict_types=1);

namespace App\Service\Repository\Category;

use App\Service\Repository\BaseRepositoryService;
use Doctrine\DBAL\Connection;

final class DeleteCategoryService extends BaseRepositoryService
{
    private Connection $connection;
    private string $table = 'categories';


    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function delete(int $id): bool
    {
        try {
            $query = "UPDATE {$this->table}
                SET deleted_at = NOW()
                WHERE id = {$id}";
            $result = $this->connection->executeQuery($query);

            return (bool) $result->rowCount();

        } catch (\Exception $e) {
            error(getExceptionStr($e));
        }

        return false;
    }
}
