<?php ob_start(); ?>

<div class="error-container">
    <div class="error-content">
        <h1>404</h1>
        <h2>صفحه مورد نظر یافت نشد!</h2>
        <p>متأسفانه صفحه‌ای که به دنبال آن هستید وجود ندارد.</p>
        <a href="<?= url() ?>" class="btn-home">بازگشت به صفحه اصلی</a>
    </div>
</div>

<style>
.error-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2rem;
    text-align: center;
    color: white;
}

.error-content {
    background: rgba(255, 255, 255, 0.1);
    padding: 3rem;
    border-radius: 20px;
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.error-content h1 {
    font-size: 8rem;
    margin: 0;
    line-height: 1;
    text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
}

.error-content h2 {
    font-size: 2rem;
    margin: 1rem 0;
}

.error-content p {
    font-size: 1.1rem;
    margin-bottom: 2rem;
}

.btn-home {
    display: inline-block;
    padding: 1rem 2rem;
    background: white;
    color: #667eea;
    text-decoration: none;
    border-radius: 50px;
    font-weight: bold;
    transition: all 0.3s ease;
}

.btn-home:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}
</style>

<?php
$content = ob_get_clean();
require BASE_PATH . '/app/views/layout/main.php';
