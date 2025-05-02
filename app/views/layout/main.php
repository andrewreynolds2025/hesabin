<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? SITE_NAME ?></title>
    <style>
        /* استایل‌های اولیه */
        body {
            font-family: Tahoma, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            direction: rtl;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background-color: #2c3e50;
            color: white;
            padding: 1rem 0;
        }
        nav .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 1.5rem;
            color: white;
            text-decoration: none;
        }
        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 2rem;
        }
        .feature-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            margin: 2rem 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <a href="<?= url() ?>" class="logo"><?= SITE_NAME ?></a>
                <ul class="nav-links">
                    <li><a href="<?= url('login') ?>">ورود</a></li>
                    <li><a href="<?= url('register') ?>">ثبت نام</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <?= $content ?? '' ?>
    </main>
</body>
</html>