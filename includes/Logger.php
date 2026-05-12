<?php
/**
 * Logger Class
 * Records errors and security events to a file.
 */

class Logger {
    private static $logFile = __DIR__ . '/../logs/api_errors.log';

    public static function log($message, $level = 'INFO') {
        $timestamp = date('Y-m-d H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown IP';
        $logEntry = "[$timestamp] [$level] [IP: $ip] $message" . PHP_EOL;
        
        file_put_contents(self::$logFile, $logEntry, FILE_APPEND);
    }

    public static function error($message) {
        self::log($message, 'ERROR');
    }

    public static function security($message) {
        self::log($message, 'SECURITY');
    }
}
?>
