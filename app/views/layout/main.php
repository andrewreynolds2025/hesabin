<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? SITE_NAME ?></title>
    <link rel="stylesheet" href="<?= url('assets/css/style.css') ?>">
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <a href="<?= url() ?>" class="logo"><?= SITE_NAME ?></a>
                <ul class="nav-links">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="<?= url('dashboard') ?>">داشبورد</a></li>
                        <li>
                            <form action="<?= url('logout') ?>" method="post" class="inline">
                                <button type="submit">خروج</button>
                            </form>
                        </li>
                    <?php else: ?>
                        <li><a href="<?= url('login') ?>">ورود</a></li>
                        <li><a href="<?= url('register') ?>">ثبت نام</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?= $_SESSION['error'] ?>
                    <?php unset($_SESSION['error']) ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success'] ?>
                    <?php unset($_SESSION['success']) ?>
                </div>
            <?php endif; ?>

            <?= $content ?? '' ?>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?= date('Y') ?> <?= SITE_NAME ?>. تمامی حقوق محفوظ است.</p>
        </div>
    </footer>

    <script src="<?= url('assets/js/app.js') ?>"></script>
</body>
</html>