<?php

declare(strict_types=1);

namespace App\Repository\Traits;

use App\Repository\Data\Data;
use App\Service\Common\DaysOffDateTimeService;
use App\Service\Repository\User\Query\SelectUserNotesQueryService;

trait UserNotesTrait
{
    private array $categoryAttributes = [
        'id',
        'name',
        'description',
    ];


    public function findOldUserNotes(
        int $id,
        bool $onlyAlive = true,
        string $attributes = '*'
    ): array
    {
        $query = SelectUserNotesQueryService::compose($id, $onlyAlive, $attributes)
            . ' AND updated_at < \''
            . DaysOffDateTimeService::get(Data::DAYS_FOR_OLD)
            . '\'';

        if ($rows = $this->connection
            ->executeQuery($query)
            ->fetchAllAssociative()) {
            return $this->setNoteCategories($rows);
        }

        return [];
    }

    public function findUserNotes(
        int $id,
        bool $onlyAlive = true,
        string $attributes = '*'
    ): array
    {
        $query = SelectUserNotesQueryService::compose($id, $onlyAlive, $attributes);
        if ($rows = $this->connection
            ->executeQuery($query)
            ->fetchAllAssociative()) {
            return $this->setNoteCategories($rows);
        }

        return [];
    }


    private function setNoteCategories(array $rows): array
    {
        $attributes = implode(',', $this->categoryAttributes);
        foreach ($rows as $key => $row) {
            $query = "SELECT {$attributes} FROM categories
                WHERE id IN (
                    SELECT category_id FROM category_note
                        WHERE note_id = {$row['id']}
                )";

            $rows[$key]['categories'] = $this->connection
                ->executeQuery($query)
                ->fetchAllAssociative();
        }

        return $rows;
    }
}
