<?php
ob_start();
?>

<link rel="stylesheet" href="<?= url('assets/css/auth.css') ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="auth-container">
    <div class="auth-box fade-in">
        <div class="auth-header">
            <h1 class="auth-title">ثبت نام در <?= SITE_NAME ?></h1>
            <p class="auth-subtitle">به جمع ما بپیوندید</p>
        </div>

        <form id="registerForm" action="<?= url('register') ?>" method="post" class="auth-form">
            <!-- نام و نام خانوادگی -->
            <div class="form-group">
                <label class="form-label" for="fullname">نام و نام خانوادگی</label>
                <input type="text" id="fullname" name="fullname" class="form-input" required
                       placeholder="نام و نام خانوادگی خود را وارد کنید">
            </div>

            <!-- نام کاربری -->
            <div class="form-group">
                <label class="form-label" for="username">نام کاربری</label>
                <input type="text" id="username" name="username" class="form-input" required
                       placeholder="یک نام کاربری منحصر به فرد انتخاب کنید">
            </div>

            <!-- ایمیل -->
            <div class="form-group">
                <label class="form-label" for="email">ایمیل</label>
                <input type="email" id="email" name="email" class="form-input" required
                       placeholder="ایمیل خود را وارد کنید">
            </div>

            <!-- رمز عبور -->
            <div class="form-group password">
                <label class="form-label" for="password">رمز عبور</label>
                <input type="password" id="password" name="password" class="form-input" required
                       placeholder="یک رمز عبور قوی انتخاب کنید">
                <button type="button" class="password-toggle">
                    <i class="fas fa-eye"></i>
                </button>
                <div class="password-strength"></div>
                <div class="password-requirements">
                    رمز عبور باید حداقل 8 کاراکتر و شامل حروف بزرگ، کوچک، اعداد و علائم خاص باشد
                </div>
            </div>

            <!-- تأیید رمز عبور -->
            <div class="form-group password">
                <label class="form-label" for="confirmPassword">تأیید رمز عبور</label>
                <input type="password" id="confirmPassword" name="confirmPassword" class="form-input" required
                       placeholder="رمز عبور را مجدداً وارد کنید">
                <button type="button" class="password-toggle">
                    <i class="fas fa-eye"></i>
                </button>
            </div>

            <!-- قوانین و مقررات -->
            <div class="form-checkbox">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">
                    <a href="<?= url('terms') ?>" target="_blank">قوانین و مقررات</a> را مطالعه کرده و می‌پذیرم
                </label>
            </div>

            <!-- دکمه ثبت نام -->
            <button type="submit" class="btn-submit">
                ثبت نام
            </button>

            <!-- لینک ورود -->
            <div class="auth-links">
                قبلاً ثبت نام کرده‌اید؟
                <a href="<?= url('login') ?>">وارد شوید</a>
            </div>
        </form>
    </div>
</div>

<script src="<?= url('assets/js/auth.js') ?>"></script>

<?php
$content = ob_get_clean();
require BASE_PATH . '/app/views/layout/main.php';
?>