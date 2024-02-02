<?php

declare(strict_types=1);

namespace App\Service\Repository\Common\Query;

final class QueryCompositorService
{

    public static function composeQueryToDeleteRow(
        string $table,
        array $data
    ): string
    {
        $wheres = self::composeWheres($data);

        return "UPDATE {$table}
            SET deleted_at = NOW()
            {$wheres}";
    }

    public static function composeQueryToGetRows(
        string $table,
        array $data,
        array $attributes = []
    ): string
    {
        $attributes = ($attributes)
            ? implode(',', $attributes)
            : '*';
        $wheres = self::composeWheres($data);

        return "SELECT {$attributes} FROM {$table} {$wheres}";
    }

    public static function composeQueryToReviveRow(
        string $table,
        array $data
    ): string
    {
        $wheres = self::composeWheres($data);

        return "UPDATE {$table}
            SET deleted_at = NULL
            {$wheres}";
    }

    public static function composeWheres(array $data): string
    {
        $wheres = ' WHERE 1';

        $counter = -1;
        foreach ($data as $key => $value) {
            $counter++;
            if ($counter === 0) {
                $wheres = " WHERE {$key} = '{$value}'";
                continue;
            }
            $wheres .= " AND {$key} = '{$value}'";
        }

        return $wheres;
    }
}
