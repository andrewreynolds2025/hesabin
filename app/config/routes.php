<?php
$router = new AltoRouter();
$router->setBasePath('/hesabin');

// صفحه اصلی
$router->map('GET', '/', 'HomeController#index', 'home');

// مسیرهای احراز هویت
$router->map('GET', '/login', 'AuthController#login', 'login');
$router->map('POST', '/login', 'AuthController#processLogin', 'process_login');
$router->map('GET', '/register', 'AuthController#register', 'register');
$router->map('POST', '/register', 'AuthController#processRegister', 'process_register');
$router->map('POST', '/logout', 'AuthController#logout', 'logout');

// مسیرهای داشبورد
$router->map('GET', '/dashboard', 'DashboardController#index', 'dashboard');