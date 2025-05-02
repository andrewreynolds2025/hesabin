<?php
$router = new AltoRouter();
$router->setBasePath('/hesabin');

// صفحه اصلی
$router->map('GET', '/', 'HomeController#index', 'home');

// مسیرهای احراز هویت
$router->map('GET', '/login', 'AuthController#login', 'login');
$router->map('GET', '/register', 'AuthController#register', 'register');