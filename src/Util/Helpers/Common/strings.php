<?php

declare(strict_types=1);


$funcName = 'getLastSlice';
if (!function_exists($funcName)) {
    function getLastSlice(string $str = '', string $separator = '/'): string
    {
        if (empty($separator)) {
            return $str;
        }

        $slices = explode($separator, $str);

        return $slices[count($slices) - 1];
    }
}

$funcName = 'sortAlphabetically';
if (!function_exists($funcName)) {
    /**
     * @param array<mixed> $array
     * @return array<mixed>
     */
    function sortAlphabetically(array $array): array
    {
        natcasesort($array);

        return array_values($array);
    }
}
