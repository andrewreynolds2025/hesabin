<?php
namespace App\Core;

class ErrorHandler {
    private $logger;
    
    public function __construct(Logger $logger) {
        $this->logger = $logger;
        
        // ثبت error handler های سیستمی
        set_error_handler([$this, 'handleError']);
        set_exception_handler([$this, 'handleException']);
        register_shutdown_function([$this, 'handleFatalError']);
    }
    
    public function handleError($errno, $errstr, $errfile, $errline) {
        $errorType = $this->getErrorType($errno);
        $message = sprintf(
            "Error: [%s] %s\nFile: %s\nLine: %d",
            $errorType,
            $errstr,
            $errfile,
            $errline
        );
        
        $context = [
            'type' => $errorType,
            'file' => $errfile,
            'line' => $errline,
            'trace' => debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)
        ];
        
        $this->logger->error($message, $context);
        
        if (ENVIRONMENT === 'development') {
            echo $this->formatErrorForDisplay($message, $context);
        } else {
            // در محیط production فقط یک پیغام مناسب نمایش داده می‌شود
            echo $this->getProductionErrorMessage();
        }
        
        return true;
    }
    
    public function handleException($exception) {
        $message = sprintf(
            "Exception: [%s] %s\nFile: %s\nLine: %d",
            get_class($exception),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine()
        );
        
        $context = [
            'type' => get_class($exception),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTrace()
        ];
        
        $this->logger->error($message, $context);
        
        if (ENVIRONMENT === 'development') {
            echo $this->formatErrorForDisplay($message, $context);
        } else {
            echo $this->getProductionErrorMessage();
        }
    }
    
    public function handleFatalError() {
        $error = error_get_last();
        if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
            $message = sprintf(
                "Fatal Error: [%s] %s\nFile: %s\nLine: %d",
                $this->getErrorType($error['type']),
                $error['message'],
                $error['file'],
                $error['line']
            );
            
            $context = [
                'type' => $this->getErrorType($error['type']),
                'file' => $error['file'],
                'line' => $error['line']
            ];
            
            $this->logger->error($message, $context);
            
            if (ENVIRONMENT === 'development') {
                echo $this->formatErrorForDisplay($message, $context);
            } else {
                echo $this->getProductionErrorMessage();
            }
        }
    }
    
    private function getErrorType($type) {
        switch($type) {
            case E_ERROR: return 'E_ERROR';
            case E_WARNING: return 'E_WARNING';
            case E_PARSE: return 'E_PARSE';
            case E_NOTICE: return 'E_NOTICE';
            case E_CORE_ERROR: return 'E_CORE_ERROR';
            case E_CORE_WARNING: return 'E_CORE_WARNING';
            case E_COMPILE_ERROR: return 'E_COMPILE_ERROR';
            case E_COMPILE_WARNING: return 'E_COMPILE_WARNING';
            case E_USER_ERROR: return 'E_USER_ERROR';
            case E_USER_WARNING: return 'E_USER_WARNING';
            case E_USER_NOTICE: return 'E_USER_NOTICE';
            case E_STRICT: return 'E_STRICT';
            case E_RECOVERABLE_ERROR: return 'E_RECOVERABLE_ERROR';
            case E_DEPRECATED: return 'E_DEPRECATED';
            case E_USER_DEPRECATED: return 'E_USER_DEPRECATED';
            default: return 'UNKNOWN';
        }
    }
    
    private function formatErrorForDisplay($message, $context) {
        $html = '<div style="margin: 20px; padding: 20px; border: 1px solid #ff0000; background-color: #ffebee;">';
        $html .= '<h2 style="color: #d32f2f;">خطای سیستم</h2>';
        $html .= '<pre style="background-color: #fff; padding: 15px; border: 1px solid #ddd;">';
        $html .= htmlspecialchars($message) . "\n\n";
        $html .= "Context:\n";
        $html .= htmlspecialchars(json_encode($context, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $html .= '</pre>';
        $html .= '</div>';
        return $html;
    }
    
    private function getProductionErrorMessage() {
        return '<div style="margin: 20px; padding: 20px; text-align: center; background-color: #f5f5f5;">
                <h2>متأسفیم!</h2>
                <p>یک خطای غیرمنتظره رخ داده است. لطفاً بعداً دوباره تلاش کنید.</p>
                <p>در صورت تداوم مشکل، با پشتیبانی تماس بگیرید.</p>
                </div>';
    }
}