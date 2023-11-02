/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */

document.addEventListener('DOMContentLoaded', function() {
    const submenuItems = document.querySelectorAll('.has-submenu');

    submenuItems.forEach(function(submenuItem) {
        submenuItem.addEventListener('click', function(e) {
            const submenu = submenuItem.querySelector('.submenu');
            const isOpen = submenu.classList.contains('open');

            if (isOpen) {
                submenu.classList.remove('open');
                submenu.style.maxHeight = null;
            } else {
                closeOtherSubmenus(submenuItem);
                submenu.classList.add('open');
                submenu.style.maxHeight = submenu.scrollHeight + 'px';
            }
        });
    });

    function closeOtherSubmenus(currentSubmenu) {
        submenuItems.forEach(function(submenuItem) {
            const submenu = submenuItem.querySelector('.submenu');
            if (submenu !== currentSubmenu.querySelector('.submenu')) {
                submenu.classList.remove('open');
                submenu.style.maxHeight = null;
            }
        });
    }
});