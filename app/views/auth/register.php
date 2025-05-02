<?php
ob_start();
?>

<div class="auth-container">
    <h1>ثبت نام</h1>
    
    <form action="<?= url('register') ?>" method="post" class="auth-form">
        <div class="form-group">
            <label for="name">نام:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">ایمیل:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">رمز عبور:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">ثبت نام</button>
        </div>

        <p class="auth-links">
            قبلاً ثبت نام کرده‌اید؟ 
            <a href="<?= url('login') ?>">وارد شوید</a>
        </p>
    </form>
</div>

<?php
$content = ob_get_clean();
require BASE_PATH . '/app/views/layout/main.php';
?>