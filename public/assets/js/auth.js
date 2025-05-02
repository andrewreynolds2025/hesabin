// توابع اعتبارسنجی و تعاملی فرم ثبت نام
document.addEventListener('DOMContentLoaded', function() {
    // متغیرهای اصلی
    const form = document.getElementById('registerForm');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const passwordToggleBtns = document.querySelectorAll('.password-toggle');
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    
    // تابع نمایش خطا
    function showError(input, message) {
        const formGroup = input.closest('.form-group');
        formGroup.classList.add('has-error');
        
        let errorDiv = formGroup.querySelector('.error-message');
        if (!errorDiv) {
            errorDiv = document.createElement('div');
            errorDiv.className = 'error-message fade-in';
            formGroup.appendChild(errorDiv);
        }
        errorDiv.textContent = message;
    }

    // تابع حذف خطا
    function removeError(input) {
        const formGroup = input.closest('.form-group');
        formGroup.classList.remove('has-error');
        const errorDiv = formGroup.querySelector('.error-message');
        if (errorDiv) {
            errorDiv.remove();
        }
    }

    // تابع بررسی قدرت رمز عبور
    function checkPasswordStrength(password) {
        let strength = 0;
        const strengthBar = document.querySelector('.password-strength-bar');
        
        // معیارهای قدرت رمز عبور
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]+/)) strength++;
        if (password.match(/[A-Z]+/)) strength++;
        if (password.match(/[0-9]+/)) strength++;
        if (password.match(/[$@#&!]+/)) strength++;

        // نمایش قدرت رمز عبور
        strengthBar.className = 'password-strength-bar';
        switch(strength) {
            case 0:
                strengthBar.style.width = '0';
                break;
            case 1:
                strengthBar.classList.add('strength-weak');
                break;
            case 2:
            case 3:
                strengthBar.classList.add('strength-medium');
                break;
            case 4:
                strengthBar.classList.add('strength-strong');
                break;
            case 5:
                strengthBar.classList.add('strength-very-strong');
                break;
        }

        return strength;
    }

    // تابع اعتبارسنجی ایمیل
    function validateEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    // تابع اعتبارسنجی نام کاربری
    function validateUsername(username) {
        const re = /^[a-zA-Z0-9_]{3,20}$/;
        return re.test(username);
    }

    // رویداد تغییر رمز عبور
    passwordInput.addEventListener('input', function() {
        const strength = checkPasswordStrength(this.value);
        const requirements = document.querySelector('.password-requirements');
        
        if (strength < 3) {
            requirements.style.color = '#e53e3e';
        } else {
            requirements.style.color = '#38a169';
        }
    });

    // رویداد تغییر تأیید رمز عبور
    confirmPasswordInput.addEventListener('input', function() {
        if (this.value !== passwordInput.value) {
            showError(this, 'رمز عبور و تکرار آن مطابقت ندارند');
        } else {
            removeError(this);
        }
    });

    // رویداد تغییر نام کاربری
    usernameInput.addEventListener('input', function() {
        if (!validateUsername(this.value)) {
            showError(this, 'نام کاربری باید شامل حروف، اعداد و _ باشد (3 تا 20 کاراکتر)');
        } else {
            removeError(this);
        }
    });

    // رویداد تغییر ایمیل
    emailInput.addEventListener('input', function() {
        if (!validateEmail(this.value)) {
            showError(this, 'لطفاً یک ایمیل معتبر وارد کنید');
        } else {
            removeError(this);
        }
    });

    // رویداد نمایش/مخفی کردن رمز عبور
    passwordToggleBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const type = input.getAttribute('type');
            
            if (type === 'password') {
                input.setAttribute('type', 'text');
                this.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                input.setAttribute('type', 'password');
                this.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });
    });

    // اعتبارسنجی فرم هنگام ارسال
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let isValid = true;

        // بررسی خالی نبودن فیلدها
        const requiredFields = form.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                showError(field, 'این فیلد الزامی است');
                isValid = false;
            }
        });

        // بررسی اعتبار نام کاربری
        if (!validateUsername(usernameInput.value)) {
            showError(usernameInput, 'نام کاربری باید شامل حروف، اعداد و _ باشد (3 تا 20 کاراکتر)');
            isValid = false;
        }

        // بررسی اعتبار ایمیل
        if (!validateEmail(emailInput.value)) {
            showError(emailInput, 'لطفاً یک ایمیل معتبر وارد کنید');
            isValid = false;
        }

        // بررسی قدرت رمز عبور
        if (checkPasswordStrength(passwordInput.value) < 3) {
            showError(passwordInput, 'رمز عبور به اندازه کافی قوی نیست');
            isValid = false;
        }

        // بررسی تطابق رمز عبور
        if (passwordInput.value !== confirmPasswordInput.value) {
            showError(confirmPasswordInput, 'رمز عبور و تکرار آن مطابقت ندارند');
            isValid = false;
        }

        // ارسال فرم در صورت معتبر بودن
        if (isValid) {
            // نمایش انیمیشن لودینگ
            const submitBtn = form.querySelector('.btn-submit');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> در حال ارسال...';
            submitBtn.disabled = true;

            // ارسال فرم
            setTimeout(() => {
                form.submit();
            }, 1000);
        }
    });

    // انیمیشن ورودی فرم
    const formInputs = document.querySelectorAll('.form-input');
    formInputs.forEach((input, index) => {
        setTimeout(() => {
            input.classList.add('fade-in');
        }, 100 * index);
    });
});