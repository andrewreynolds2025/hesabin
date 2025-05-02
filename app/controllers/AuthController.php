<?php
namespace App\Controllers;

class AuthController
{
    public function register()
    {
        view('auth/register', [
            'title' => 'ثبت نام در ' . SITE_NAME
        ]);
    }

    public function processRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = $_POST['fullname'] ?? '';
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmPassword'] ?? '';
            $terms = isset($_POST['terms']);

            // اعتبارسنجی سمت سرور
            $errors = [];

            // بررسی خالی نبودن فیلدها
            if (empty($fullname)) $errors[] = 'نام و نام خانوادگی الزامی است';
            if (empty($username)) $errors[] = 'نام کاربری الزامی است';
            if (empty($email)) $errors[] = 'ایمیل الزامی است';
            if (empty($password)) $errors[] = 'رمز عبور الزامی است';
            if (empty($confirmPassword)) $errors[] = 'تأیید رمز عبور الزامی است';
            if (!$terms) $errors[] = 'پذیرش قوانین و مقررات الزامی است';

            // بررسی فرمت نام کاربری
            if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
                $errors[] = 'نام کاربری باید شامل حروف، اعداد و _ باشد (3 تا 20 کاراکتر)';
            }

            // بررسی فرمت ایمیل
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'ایمیل وارد شده معتبر نیست';
            }

            // بررسی قدرت رمز عبور
            if (strlen($password) < 8) {
                $errors[] = 'رمز عبور باید حداقل 8 کاراکتر باشد';
            }

            // بررسی تطابق رمز عبور
            if ($password !== $confirmPassword) {
                $errors[] = 'رمز عبور و تکرار آن مطابقت ندارند';
            }

            // در صورت وجود خطا
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old_input'] = [
                    'fullname' => $fullname,
                    'username' => $username,
                    'email' => $email
                ];
                header('Location: ' . url('register'));
                exit;
            }

            // در صورت موفقیت
            $_SESSION['success'] = 'ثبت نام با موفقیت انجام شد';
            header('Location: ' . url('login'));
            exit;
        }
    }
}