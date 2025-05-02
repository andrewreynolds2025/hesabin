<?php
namespace App\Core;

class Logger {
    private $logFile;
    private $logPath;
    
    public function __construct() {
        $this->logPath = dirname(dirname(__DIR__)) . '/logs/';
        if (!file_exists($this->logPath)) {
            mkdir($this->logPath, 0777, true);
        }
        $this->logFile = $this->logPath . date('Y-m-d') . '.log';
    }
    
    public function log($level, $message, $context = []) {
        $timestamp = date('Y-m-d H:i:s');
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'Unknown IP';
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown User Agent';
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'Not logged in';
        $url = $_SERVER['REQUEST_URI'] ?? 'Unknown URL';
        
        $logMessage = sprintf(
            "[%s] [%s] [IP: %s] [User ID: %s] [URL: %s]\n%s\n%s\n%s\n\n",
            $timestamp,
            strtoupper($level),
            $ipAddress,
            $userId,
            $url,
            $message,
            !empty($context) ? "Context: " . json_encode($context, JSON_UNESCAPED_UNICODE) : '',
            str_repeat('-', 80)
        );
        
        error_log($logMessage, 3, $this->logFile);
    }
    
    public function error($message, $context = []) {
        $this->log('error', $message, $context);
    }
    
    public function info($message, $context = []) {
        $this->log('info', $message, $context);
    }
    
    public function warning($message, $context = []) {
        $this->log('warning', $message, $context);
    }
    
    public function debug($message, $context = []) {
        if (ENVIRONMENT === 'development') {
            $this->log('debug', $message, $context);
        }
    }
}