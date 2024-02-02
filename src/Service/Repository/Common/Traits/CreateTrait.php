<?php

declare(strict_types=1);

namespace App\Service\Repository\Common\Traits;

trait CreateTrait
{

    public function create(array $data): int
    {
        try {
            $queryBuilder = $this->connection->createQueryBuilder();
            $queryBuilder->insert($this->table)
                ->values($this->prepareQueryBuilderValues($data));
            $queryBuilder
                = $this->setQueryBuilderParameters($queryBuilder, $data);

            return $queryBuilder->executeQuery()->rowCount();

        } catch (\Exception $e) {
            error(getExceptionStr($e));
        }

        return 0;
    }
}
