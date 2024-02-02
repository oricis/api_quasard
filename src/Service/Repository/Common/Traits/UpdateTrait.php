<?php

declare(strict_types=1);

namespace App\Service\Repository\Common\Traits;

trait UpdateTrait
{

    public function update(array $data): int
    {
        try {
            $queryBuilder = $this->connection->createQueryBuilder();
            $queryBuilder->update($this->table)->where('id = ' . $data['id']);
            unset($data['id']);

            $queryBuilder
                = $this->prepareUpdateQueryBuilderValues($queryBuilder, $data);
            $queryBuilder
                = $this->setQueryBuilderParameters($queryBuilder, $data);

            return $queryBuilder->executeQuery()->rowCount();

        } catch (\Exception $e) {
            error(getExceptionStr($e));
        }

        return 0;
    }
}
