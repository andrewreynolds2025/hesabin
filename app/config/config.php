<?php
// تنظیمات محیط برنامه
define('ENVIRONMENT', 'development'); // یا 'production'

// تنظیمات مسیر لاگ‌ها
define('LOG_PATH', dirname(dirname(__DIR__)) . '/logs/');

// تنظیمات پایه
define('SITE_NAME', 'حسابین');
define('APP_URL', 'http://localhost/hesabin');

// تنظیمات دیتابیس
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hesabin');

// توابع کمکی
function url($path = '') {
    return APP_URL . '/' . ltrim($path, '/');
}

function view($name, $data = []) {
    extract($data);
    require BASE_PATH . '/app/views/' . $name . '.php';
}

function redirect($path) {
    header('Location: ' . url($path));
    exit;
}