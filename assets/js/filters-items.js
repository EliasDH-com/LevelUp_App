/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */

//****************************************************************************************************//

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


//****************************************************************************************************//

// Function to toggle the visibility of the table attributes
document.getElementById('statusFilter').addEventListener('change', function() {
    const selectedStatus = this.value;
    const rows = document.querySelectorAll('table tr');

    rows.forEach(function(row, index) {
        if (index !== 0) {
            const statusCell = row.querySelector('td:nth-child(2)');
            if (statusCell) {
                if (selectedStatus === 'all') {
                    row.style.display = 'table-row';
                } else {
                    const cellText = statusCell.innerText.toLowerCase();
                    const filterValue = selectedStatus.toLowerCase();

                    if (cellText.includes(filterValue)) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                }
            }
        }
    });
});

//****************************************************************************************************//