<?php

declare(strict_types=1);

namespace App\Service\Repository\Common\Traits;

use App\Service\Repository\Common\Query\QueryCompositorService;

trait DeleteTrait
{

    public function delete(int $id): bool
    {
        try {
            $query = QueryCompositorService::composeQueryToDeleteRow(
                $this->table,
                ['id' => $id]
            );
            $result = $this->connection->executeQuery($query);

            return (bool) $result->rowCount();

        } catch (\Exception $e) {
            error(getExceptionStr($e));
        }

        return false;
    }
}
