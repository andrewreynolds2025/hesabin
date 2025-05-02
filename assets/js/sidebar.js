document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    
    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        // ذخیره وضعیت در localStorage
        localStorage.setItem('sidebarState', 
            sidebar.classList.contains('collapsed') ? 'collapsed' : 'expanded');
    });
});