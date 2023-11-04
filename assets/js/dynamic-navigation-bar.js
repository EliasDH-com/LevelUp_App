/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */


// Function to add the active class to the current page in the navigation bar and open the submenu
document.addEventListener('DOMContentLoaded', function() {
    const submenuItems = document.querySelectorAll('.has-submenu');
    const collapseButton = document.getElementById('collapse-button');
    const navigationBar = document.querySelector('.navigation-bar');

    // Eventlistener voor collapse button
    collapseButton.addEventListener('click', function(e) {
        e.preventDefault();
        navigationBar.classList.toggle('collapsed');
        // Toggle de class 'collapsed' op de navigation-bar
    });

    // Eventlisteners voor submenu's
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


// Function to adjust the padding of the main content
document.addEventListener('DOMContentLoaded', function() {
    const navigationBar = document.querySelector('.navigation-bar');
    const mainContent = document.querySelector('.main-content');

    const collapseButton = document.getElementById('collapse-button');
    collapseButton.addEventListener('click', function() {
        if (navigationBar.classList.contains('collapsed')) {
            mainContent.style.paddingLeft = '1px'; // Aanpassen naar de breedte van de ingeklapte navigatiebalk
        } else {
            mainContent.style.paddingLeft = '200px'; // Aanpassen naar de breedte van de uitgeklapte navigatiebalk
        }
    });
});


// Function to open and close the info window
function openInfoWindow() {
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('infoWindow').style.display = 'block';
}

function closeInfoWindow() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('infoWindow').style.display = 'none';
}


// Function to toggle the language of the info window
function openLanguagePopup() {
    const languagePopup = document.getElementById('languagePopup');
    languagePopup.style.display = 'block';
}

function closeLanguagePopup() {
    const languagePopup = document.getElementById('languagePopup');
    languagePopup.style.display = 'none';
}

function toggleLanguage(language) {
    closeLanguagePopup();
    
    const languages = ['EN', 'NL', 'FR'];
    languages.forEach(lang => {
        const infoTitle = document.getElementById(`infoTitle${lang}`);
        const infoContent = document.getElementById(`infoContent${lang}`);

        if (lang === language) {
            infoTitle.style.display = 'block';
            infoContent.style.display = 'block';
        } else {
            infoTitle.style.display = 'none';
            infoContent.style.display = 'none';
        }
    });
}