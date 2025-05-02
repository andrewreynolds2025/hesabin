<?php
namespace App\Controllers;

use App\Core\Logger;

class AuthController
{
    private $logger;
    
    public function __construct()
    {
        $this->logger = new Logger();
    }

    public function register()
    {
        view('auth/register', [
            'title' => 'ثبت نام در ' . SITE_NAME
        ]);
    }

    private function validateRegistrationData($data)
    {
        $errors = [];

        $fullname = $data['fullname'] ?? '';
        $username = $data['username'] ?? '';
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';
        $confirmPassword = $data['confirmPassword'] ?? '';
        $terms = isset($data['terms']);

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

        if (!empty($errors)) {
            return ['valid' => false, 'errors' => $errors];
        }

        return ['valid' => true];
    }

    public function processRegister()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new \Exception('درخواست نامعتبر');
            }

            // ثبت درخواست ثبت‌نام
            $this->logger->info('Registration attempt', [
                'email' => $_POST['email'] ?? null,
                'username' => $_POST['username'] ?? null
            ]);

            // اعتبارسنجی داده‌ها
            $validation = $this->validateRegistrationData($_POST);
            
            if (!$validation['valid']) {
                $_SESSION['errors'] = $validation['errors'];
                $_SESSION['old_input'] = [
                    'fullname' => $_POST['fullname'] ?? '',
                    'username' => $_POST['username'] ?? '',
                    'email' => $_POST['email'] ?? ''
                ];
                
                $this->logger->warning('Registration validation failed', [
                    'errors' => $validation['errors']
                ]);
                
                header('Location: ' . url('register'));
                exit;
            }

            // ایجاد کاربر در دیتابیس
            try {
                // اینجا کد مربوط به ذخیره‌سازی کاربر در دیتابیس قرار می‌گیرد
                // فعلاً به صورت موقت پیام موفقیت نمایش می‌دهیم
                
                $this->logger->info('User registered successfully', [
                    'username' => $_POST['username'],
                    'email' => $_POST['email']
                ]);

                $_SESSION['success'] = 'ثبت نام با موفقیت انجام شد';
                header('Location: ' . url('login'));
                exit;
                
            } catch (\Exception $e) {
                $this->logger->error('Database error during registration', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                
                $_SESSION['errors'] = ['خطا در ثبت اطلاعات. لطفاً دوباره تلاش کنید.'];
                header('Location: ' . url('register'));
                exit;
            }

        } catch (\Exception $e) {
            $this->logger->error('Registration process failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            $_SESSION['errors'] = ['خطای سیستمی رخ داده است. لطفاً دوباره تلاش کنید.'];
            header('Location: ' . url('register'));
            exit;
        }
    }
}