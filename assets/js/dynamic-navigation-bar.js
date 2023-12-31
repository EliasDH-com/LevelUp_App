/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */

//****************************************************************************************************//

// Function to add the active class to the current page in the navigation bar and open the submenu
document.addEventListener('DOMContentLoaded', function() {
    const submenuItems = document.querySelectorAll('.has-submenu');
    const collapseButton = document.getElementById('collapse-button');
    const navigationBar = document.querySelector('.navigation-bar');

    collapseButton.addEventListener('click', function(e) {
        e.preventDefault();
        navigationBar.classList.toggle('collapsed');
    });

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

//****************************************************************************************************//

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

//****************************************************************************************************//

// Function showing all notifications from the user in question
function openNotificationsPopup() {
    toggleStickyPositionTable(); // This function is defined in /assets/js/filters-items.js
    document.getElementById('overlay').style.display = 'block';
    const notificationsPopup = document.getElementById('notificationsPopup');
    notificationsPopup.style.display = 'block';
    getNotifications(userId);
}

function closeNotificationsPopup() {
    toggleStickyPositionTable(); // This function is defined in /assets/js/filters-items.js
    document.getElementById('overlay').style.display = 'none';
    const notificationsPopup = document.getElementById('notificationsPopup');
    notificationsPopup.style.display = 'none';
}

function getNotifications(userId) {
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const notifications = JSON.parse(xhr.responseText);
                displayNotifications(notifications);
            }
        }
    };

    xhr.open('GET', '/assets/php/get-user-notifications.php?user_id=' + userId, true);
    xhr.send();
}

function displayNotifications(notifications) {
    const notificationsText = document.getElementById('notifications');
    notificationsText.innerHTML = '';

    function formatDate(date) {
        const formattedDate = new Date(date);
        const day = formattedDate.getDate().toString().padStart(2, '0');
        const month = (formattedDate.getMonth() + 1).toString().padStart(2, '0');
        const year = formattedDate.getFullYear();
        return `${day}/${month}/${year}`;
    }

    for (const key in notifications) {
        if (notifications.hasOwnProperty(key)) {
            const item = notifications[key];
            let statusText = '';
            if (item['status'] == 0) {
                statusText = 'Incomplete';
            } else if (item['status'] == 1) {
                statusText = 'Completed';
            } else {
                statusText = 'Status Unknown';
            }
            const formattedDeadline = formatDate(item['deadline']);
            notificationsText.innerHTML += `<strong>${item['name']}</strong><br>Status: ${statusText}<br>Deadline: ${formattedDeadline}<br><br>`;
        }
    }
}

//****************************************************************************************************//

// Function to open and close the user info popup window
function openUserInfoPopup() {
    toggleStickyPositionTable(); // This function is defined in /assets/js/filters-items.js
    const userInfoPopup = document.getElementById('userInfoPopup');
    document.getElementById('overlay').style.display = 'block';
    userInfoPopup.style.display = 'block';
    getUserInfo(userId);
}

function closeUserInfoPopup() {
    toggleStickyPositionTable(); // This function is defined in /assets/js/filters-items.js
    const userInfoPopup = document.getElementById('userInfoPopup');
    document.getElementById('overlay').style.display = 'none';
    userInfoPopup.style.display = 'none';
}

function getUserInfo(userId) {
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const userInfo = JSON.parse(xhr.responseText);
                displayUserInfo(userInfo);
            }
        }
    };

    xhr.open('GET', '/assets/php/get-user-information.php?user_id=' + userId, true);
    xhr.send();
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function capitalizeAttribute(attribute) {
    return attribute.charAt(0).toUpperCase() + attribute.slice(1).toLowerCase();
}

function displayUserInfo(userInfo) {
    const userInfoText = document.getElementById('userInfo');
    userInfoText.innerHTML = '';

    for (const key in userInfo) {
        if (userInfo.hasOwnProperty(key)) {
            const capitalizedKey = capitalizeAttribute(key);
            const capitalizedValue = capitalizeFirstLetter(userInfo[key]);
            userInfoText.innerHTML += `<strong>${capitalizedKey}:</strong> ${capitalizedValue}<br>`;
        }
    }
}

//****************************************************************************************************//

// Function to open and close the info window
function openInfoWindow() {
    toggleStickyPositionTable(); // This function is defined in /assets/js/filters-items.js
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('infoWindow').style.display = 'block';
}

function closeInfoWindow() {
    toggleStickyPositionTable(); // This function is defined in /assets/js/filters-items.js
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('infoWindow').style.display = 'none';
}

function changeLanguage(selectedLanguage) {
    const languages = ['EN', 'NL', 'FR'];
    languages.forEach(lang => {
        const infoTitle = document.getElementById(`infoTitle${lang}`);
        const infoContent = document.getElementById(`infoContent${lang}`);

        if (lang === selectedLanguage) {
            infoTitle.style.display = 'block';
            infoContent.style.display = 'block';
        } else {
            infoTitle.style.display = 'none';
            infoContent.style.display = 'none';
        }
    });
}

//****************************************************************************************************//