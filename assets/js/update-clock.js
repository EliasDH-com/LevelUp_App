/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */

function updateClock() {
    const now = new Date();
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');
    const formattedTime = `${hours}:${minutes}:${seconds}`;
    document.getElementById("clock").textContent = formattedTime;
}
// Update de klok elke seconde
setInterval(updateClock, 1000);
// Voer de klokfunctie ook meteen uit om de klok in te stellen
updateClock();