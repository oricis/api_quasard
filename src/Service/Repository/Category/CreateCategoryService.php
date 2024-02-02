<?php

declare(strict_types=1);

namespace App\Services\Categories;

use App\Exceptions\CreateEntityException;
use App\Service\Repository\BaseRepositoryService;
use Doctrine\DBAL\Connection;

final class CreateCategoryService extends BaseRepositoryService
{
    private Connection $connection;
    private string $table = 'categories';



    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }


    public function create(array $data): int
    {
        try {
            $queryBuilder = $this->connection->createQueryBuilder();
            $queryBuilder
                ->insert($this->table)
                ->values($this->prepareQueryBuilderValues($data));
            $queryBuilder = $this->setQueryBuilderParameters($queryBuilder, $data);

            $lastInsertIdBefore = $this->connection->lastInsertId(); // HACK:
            $queryBuilder->executeQuery();

            return (int) $lastInsertIdBefore < $this->connection->lastInsertId();


        } catch (\Exception $e) {
            error(getExceptionStr($e));
        }

        return 0;
    }
}
