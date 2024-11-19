<?php

declare(strict_types=1);

namespace App\Util\Interfaces;

interface ResponseServiceInterface
{
    /**
     * @return array<string,mixed>
     */
    public static function get(object $object): array;
}
