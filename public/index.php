<?php
session_start();

// تنظیمات اولیه
define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/vendor/autoload.php';

// تنظیمات اپلیکیشن
require_once BASE_PATH . '/app/config/config.php';
require_once BASE_PATH . '/app/config/routes.php';

// پردازش درخواست
$match = $router->match();

// کنترلر پیش‌فرض
$controller = 'HomeController';
$method = 'index';
$params = [];

if ($match) {
    if (is_string($match['target'])) {
        list($controller, $method) = explode('#', $match['target']);
    }
    if (is_array($match['params'])) {
        $params = $match['params'];
    }
    
    // افزودن مسیر کنترلر
    $controller = "App\\Controllers\\{$controller}";
    
    if (class_exists($controller)) {
        $controller = new $controller();
        if (method_exists($controller, $method)) {
            call_user_func_array([$controller, $method], $params);
            return;
        }
    }
}

// صفحه 404
header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
try {
    require BASE_PATH . '/app/views/404.php';
} catch (Exception $e) {
    echo '<div style="text-align: center; padding: 50px; font-family: Tahoma;">';
    echo '<h1>404 - صفحه مورد نظر یافت نشد</h1>';
    echo '<p>متأسفانه صفحه‌ای که به دنبال آن هستید در دسترس نیست.</p>';
    echo '<a href="' . url() . '">بازگشت به صفحه اصلی</a>';
    echo '</div>';
}