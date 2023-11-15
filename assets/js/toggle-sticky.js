/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */

// Function to toggle the sticky position of the table attributes
function toggleStickyPositionTable() {
    const elements = document.querySelectorAll('.table-attributes');

    elements.forEach(element => {
        if (element.classList.contains('sticky')) {
            element.classList.remove('sticky');
        } else {
            element.classList.add('sticky');
        }
    });
}