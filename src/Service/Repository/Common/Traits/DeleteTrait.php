<?php

declare(strict_types=1);

namespace App\Service\Repository\Common\Traits;

trait DeleteTrait
{

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
