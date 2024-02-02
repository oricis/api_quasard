<?php

declare(strict_types=1);

namespace App\Service\Repository\CategoryNote;

use App\Service\Repository\BaseRepositoryService;
use App\Service\Repository\Common\Query\QueryCompositorService;
use Doctrine\DBAL\Connection;

final class SelectCategoryNoteService extends BaseRepositoryService
{
    private Connection $connection;
    private string $table = 'category_note';


    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function existCategoryNoteRelation(array $data): bool
    {
        $query = QueryCompositorService::composeQueryToGetRows(
            $this->table,
            $data,
            ['id']
        );

        return (bool) $this->connection->executeQuery($query)->fetchOne();
    }
}
