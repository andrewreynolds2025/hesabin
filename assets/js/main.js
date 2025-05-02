// تنظیمات SweetAlert2
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    customClass: {
        popup: 'rtl-alert'
    }
});

// مدیریت سایدبار
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');

    // بررسی وضعیت قبلی سایدبار
    const sidebarState = localStorage.getItem('sidebarState');
    if (sidebarState === 'collapsed') {
        sidebar.classList.add('collapsed');
        mainContent.style.marginRight = 'var(--sidebar-collapsed-width)';
    }

    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        const isCollapsed = sidebar.classList.contains('collapsed');
        localStorage.setItem('sidebarState', isCollapsed ? 'collapsed' : 'expanded');
        
        mainContent.style.marginRight = isCollapsed ? 
            'var(--sidebar-collapsed-width)' : 
            'var(--sidebar-width)';
    });
});

// تابع نمایش نوتیفیکیشن
function showNotification(type, message) {
    Toast.fire({
        icon: type,
        title: message
    });
}