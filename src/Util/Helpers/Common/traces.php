<?php

declare(strict_types=1);


$funcName = 'dd';
if (!function_exists($funcName)) {
    function dd(): void
    {
        dump(func_get_args());
        die();
    }
}

$funcName = 'dump';
if (!function_exists($funcName)) {
    function dump(): void
    {
        foreach (func_get_args() as $arg) {
            if (is_array($arg)) {
                foreach ($arg as $key => $value) {
                    if (is_numeric($value) || is_string($value)) {
                        echo $key . ' => ' . $value . '<br>';
                        continue;
                    }
                    if (is_array($value)) {
                        dump($value);
                        continue;
                    }

                    var_dump($value);
                    echo '<br>';
                }
            } else {
                if (is_string($arg) || is_numeric($arg)) {
                    echo $arg . '<br>';
                    continue;
                }
                var_dump($arg);
            }
            echo '<br>';
        }
    }
}

$funcName = 'getExceptionStr';
if (!function_exists($funcName)) {
    function getExceptionStr(\Exception $exception): string
    {
        return date('Y-m-d H:i:s')
            . '<br>File: ' . $exception->getFile() . PHP_EOL
            . ' / Line: ' . $exception->getLine() . PHP_EOL
            . '<br>' . get_class($exception) . ': ' . $exception->getMessage();
    }
}

$funcName = 'go';
if (!function_exists($funcName)) {
    /**
     * @param array<mixed> $backtrace
     */
    function go(array $backtrace = [], int $level = 1): string
    {
        $backtrace = ($backtrace)
            ? $backtrace
            : debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $level + 1);

        $funcName = 'function_name_no_present';
        $shortedClassName = 'func ';

        if (isset($backtrace[$level])
            && is_array($backtrace[$level])) {
            $backtraceLevel = $backtrace[$level];

            $temp = (isset($backtraceLevel['function']))
                ? $backtraceLevel['function']
                : null;
            $funcName = (is_string($temp))
                ? $temp
                : $funcName;

            $temp = (isset($backtraceLevel['class']))
                ? $backtraceLevel['class']
                : null;
            $shortedClassName = (is_string($temp))
                ? getLastSlice($temp, '\\')
                : $shortedClassName;
        }

        return $shortedClassName . '@' . $funcName;
    }
}
