<?php

namespace App\Util\Misc;

final class ApiUtils
{

    /**
     * @return array<string,string>
     */
    public static function composeApiHeaders(string $token): array
    {
        return [
            'Accept'  => 'application/json',
            'Api-key' => $token,
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * @return array<string,string>
     */
    public static function composeAuthenticatedHeaders(string $token, string $bearer): array
    {
        $apiHeaders = self::composeApiHeaders($token);

        return array(
            ...$apiHeaders,
            'Authorization' => 'Bearer ' . $bearer,
        );
    }

    public static function generateToken(int $length = 32): string
    {
        if ($length <= 0) {
            $length = 1;
        }

        return bin2hex(random_bytes($length));
    }
}
