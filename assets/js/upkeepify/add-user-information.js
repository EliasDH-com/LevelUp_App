/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */

document.getElementById('addUserForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var formData = new FormData(this);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/assets/php/add-user-information.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var responseMessage = document.getElementById('responseMessage');
            responseMessage.innerHTML = 'User toegevoegd!';
            responseMessage.classList.add('success');
            responseMessage.style.display = 'block';
        } else {
            var responseMessage = document.getElementById('responseMessage');
            responseMessage.innerHTML = 'Er is een probleem opgetreden bij het verwerken van het verzoek.';
            responseMessage.classList.add('error');
            responseMessage.style.display = 'block';
        }
    };

    xhr.send(formData);
});