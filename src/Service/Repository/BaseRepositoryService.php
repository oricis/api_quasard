<?php

declare(strict_types=1);

namespace App\Service\Repository;

use Doctrine\DBAL\Query\QueryBuilder;

class BaseRepositoryService
{

    protected function prepareQueryBuilderValues(array $data): array
    {
        $output = [];
        foreach ($data as $key => $value) {
            $output[$key] = '?';
        }

        return $output;
    }

    protected function setQueryBuilderParameters(
        QueryBuilder $queryBuilder,
        array $data
    ): QueryBuilder
    {
        $index = 0;
        foreach ($data as $value) {
            $queryBuilder = $queryBuilder->setParameter($index, $value);
            $index++;
        }

        return $queryBuilder;
    }
}
