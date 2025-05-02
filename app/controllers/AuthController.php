<?php
namespace App\Controllers;

class AuthController
{
    public function login()
    {
        view('auth/login', [
            'title' => 'ورود به سیستم'
        ]);
    }

    public function register()
    {
        view('auth/register', [
            'title' => 'ثبت نام'
        ]);
    }

    public function processLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // اعتبارسنجی
            if (empty($email) || empty($password)) {
                $_SESSION['error'] = 'لطفا همه فیلدها را پر کنید';
                redirect('login');
                return;
            }

            // بررسی اعتبار کاربر
            // ...

            redirect('dashboard');
        }
    }

    public function processRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // اعتبارسنجی
            if (empty($name) || empty($email) || empty($password)) {
                $_SESSION['error'] = 'لطفا همه فیلدها را پر کنید';
                redirect('register');
                return;
            }

            // ثبت کاربر
            // ...

            $_SESSION['success'] = 'ثبت نام با موفقیت انجام شد';
            redirect('login');
        }
    }

    public function logout()
    {
        session_destroy();
        redirect('login');
    }
}