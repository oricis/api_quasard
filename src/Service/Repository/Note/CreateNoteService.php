<?php

declare(strict_types=1);

namespace App\Service\Repository\Note;

use App\Service\Repository\BaseRepositoryService;
use App\Service\Repository\CategoryNote\CreateCategoryNoteService;
use App\Service\Repository\CategoryNote\SelectCategoryNoteService;
use App\Service\Repository\Common\Traits\CreateTrait;
use Doctrine\DBAL\Connection;

final class CreateNoteService extends BaseRepositoryService
{
    use CreateTrait;

    private Connection $connection;
    private string $table = 'notes';


    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function createNote(array $data): int
    {
        try {
            $categoryIds = explode(',', $data['categories']);
            unset($data['categories']);

            if ($this->create($data)) {
                $noteId = (int) $this->connection->lastInsertId();
                return $this->setNoteCategories($noteId, $categoryIds);
            }

        } catch (\Exception $e) {
            error(getExceptionStr($e));
        }

        return 0;
    }


    private function existCategoryNoteRelation(array $data): bool
    {
        return (new SelectCategoryNoteService($this->connection))
            ->existCategoryNoteRelation($data);
    }

    private function setNoteCategories(int $noteId, array $categoryIds): int
    {
        $service = new CreateCategoryNoteService($this->connection);

        $successTotal = 0;
        foreach ($categoryIds as $categoryId) {
            $data = [
                'category_id' => $categoryId,
                'note_id'     => $noteId,
            ];

            if ($this->existCategoryNoteRelation($data)) {
                $successTotal++;
                continue;
            }
            if ($service->create($data)) {
                $successTotal++;
            }
        }

        return $successTotal;
    }
}
