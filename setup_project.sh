#!/bin/bash

# ساخت دایرکتوری‌های اصلی
mkdir -p app/controllers
mkdir -p app/models
mkdir -p app/views/layout
mkdir -p app/views/home
mkdir -p app/views/auth
mkdir -p app/config
mkdir -p lib
mkdir -p public

# فایل‌های root
touch composer.json
touch .htaccess

# فایل‌های مربوط به public/
touch public/index.php
touch public/.htaccess

# فایل‌های کنترلر
touch app/controllers/HomeController.php
touch app/controllers/AuthController.php

# فایل‌های مدل
touch app/models/User.php

# فایل‌های ویو
touch app/views/layout/main.php
touch app/views/home/index.php
touch app/views/auth/login.php
touch app/views/auth/register.php

# فایل‌های کانفیگ
touch app/config/config.php
touch app/config/routes.php

# فایل‌های lib
touch lib/AltroRouter.php

# نمونه‌ای برای composer.json
cat > composer.json << EOL
{
  "require": {}
}
EOL

echo "ساختار پروژه کامل شد."