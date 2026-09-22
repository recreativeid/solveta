<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 */

if (! function_exists('is_mysql_alive')) {
    function is_mysql_alive(): bool
    {
        static $alive = null;
        if ($alive !== null) {
            return $alive;
        }

        try {
            $host = env('database.default.hostname', '127.0.0.1');
            $port = (int) env('database.default.port', 3306);
            if ($host === 'localhost') {
                $host = '127.0.0.1';
            }
            $fp = @fsockopen($host, $port, $errno, $errstr, 0.3);
            if ($fp) {
                fclose($fp);
                return $alive = true;
            }
        } catch (\Throwable $e) {}

        return $alive = false;
    }
}
