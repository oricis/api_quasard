<?php

declare(strict_types=1);

namespace App\Service\Repository\User\Query;

final class SelectUserNotesQueryService
{

    public static function compose(
        int $id,
        bool $onlyAlive = true,
        string $attributes = '*'
    ): string
    {
        if ($attributes !== '*' && !str_contains($attributes, 'id')) {
            $attributes .= ',id';
        }

        $query = "SELECT {$attributes} FROM notes
            WHERE user_id = {$id}";

        if ($onlyAlive) {
            $query = "SELECT {$attributes} FROM notes
                WHERE user_id IN (
                    SELECT id FROM users
                        WHERE id = {$id}
                        AND deleted_at IS NULL
                )";
            $query .= ' AND deleted_at IS NULL';
        }

        return $query;
    }
}
