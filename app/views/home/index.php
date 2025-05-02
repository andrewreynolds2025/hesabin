<?php
ob_start();
?>

<div class="container">
    <h1>به حسابین خوش آمدید</h1>
    <p>سیستم مدیریت حسابداری ساده و کارآمد</p>
    
    <div class="features">
        <div class="feature-box">
            <h3>مدیریت مالی</h3>
            <p>ثبت و مدیریت درآمدها و هزینه‌ها</p>
        </div>
        <div class="feature-box">
            <h3>گزارش‌گیری</h3>
            <p>گزارش‌های متنوع از وضعیت مالی</p>
        </div>
        <div class="feature-box">
            <h3>حسابداری ساده</h3>
            <p>رابط کاربری ساده و کاربرپسند</p>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require BASE_PATH . '/app/views/layout/main.php';
?>