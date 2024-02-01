<?php

declare(strict_types=1);

$funcName = 'error';
if (!function_exists($funcName)) {
    function error(string $message): void
    {
        logger($message . '<br>', 'error');
    }
}

$funcName = 'logger';
if (!function_exists($funcName)) {
    function logger(string $message, string $level = 'warn'): void
    {
        $level = trim(strtoupper($level));
        if ($level === 'WARN') {
            $level = 'WARNING';
        }
        $message = $level . ': ' . $message;
        $dateTime = date('d-m-Y - h:m:s');
        $today = date('d_m_Y');
        $path = dirname(__DIR__, 3) . '/var/log/' . $today . '.md';
        file_put_contents(
            $path,
            $dateTime . ' > ' . $message . PHP_EOL,
            FILE_APPEND
        );
    }
}

$funcName = 'notice';
if (!function_exists($funcName)) {
    function notice(string $message): void
    {
        logger($message, 'notice');
    }
}

$funcName = 'warn';
if (!function_exists($funcName)) {
    function warn(string $message): void
    {
        logger($message, 'warn');
    }
}
