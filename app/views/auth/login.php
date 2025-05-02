<?php
ob_start();
?>

<div class="auth-container">
    <h1>ورود به سیستم</h1>
    
    <form action="<?= url('login') ?>" method="post" class="auth-form">
        <div class="form-group">
            <label for="email">ایمیل:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">رمز عبور:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">ورود</button>
        </div>

        <p class="auth-links">
            حساب کاربری ندارید؟ 
            <a href="<?= url('register') ?>">ثبت نام کنید</a>
        </p>
    </form>
</div>

<?php
$content = ob_get_clean();
require BASE_PATH . '/app/views/layout/main.php';
?>