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

    protected function prepareUpdateQueryBuilderValues(
        QueryBuilder $queryBuilder,
        array $data
    ): QueryBuilder
    {
        foreach ($data as $key => $value) {
            $queryBuilder = $queryBuilder->set($key, '?');
        }

        return $queryBuilder;
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

    protected function traceQueryBuilder(QueryBuilder $queryBuilder): void
    {
        $data = [
            'params' => $queryBuilder->getParameters(),
            'sql'    => $queryBuilder->getSQL(),
        ];

        dump($data);
    }
}
