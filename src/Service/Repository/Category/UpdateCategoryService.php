<?php

declare(strict_types=1);

namespace App\Service\Repository\Category;

use App\Service\Repository\BaseRepositoryService;
use Doctrine\DBAL\Connection;

final class UpdateCategoryService extends BaseRepositoryService
{
    private Connection $connection;
    private string $table = 'categories';


    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

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
