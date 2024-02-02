<?php

declare(strict_types=1);

namespace App\Service\Repository\Note;

use App\Service\Repository\BaseRepositoryService;
use App\Service\Repository\CategoryNote\CreateCategoryNoteService;
use App\Service\Repository\CategoryNote\SelectCategoryNoteService;
use App\Service\Repository\Common\Query\QueryCompositorService;
use App\Service\Repository\Common\Traits\UpdateTrait;
use Doctrine\DBAL\Connection;

final class UpdateNoteService extends BaseRepositoryService
{
    use UpdateTrait;

    private Connection $connection;
    private string $table = 'notes';


    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function removeCategory(array $data): int
    {
        try {
            $query = QueryCompositorService::composeQueryToDeleteRow(
                'category_note',
                $data
            );
            $result = $this->connection->executeQuery($query);

            return $result->rowCount();

        } catch (\Exception $e) {
            error(getExceptionStr($e));
        }

        return 0;
    }

    public function setCategory(array $data): int
    {
        try {
            $service = new SelectCategoryNoteService($this->connection);
            if ($service->existCategoryNoteRelation($data)) {
                $query = QueryCompositorService::composeQueryToReviveRow(
                    'category_note',
                    $data
                );

                return $this->connection->executeQuery($query)->rowCount();
            }
            $service = new CreateCategoryNoteService($this->connection);

            return $service->create($data);

        } catch (\Exception $e) {
            error(getExceptionStr($e));
        }

        return 0;
    }
}
