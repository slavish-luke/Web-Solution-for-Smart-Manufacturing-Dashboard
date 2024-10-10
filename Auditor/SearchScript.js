document.addEventListener('DOMContentLoaded', function () {
    // Ensure the DOM is fully loaded before running the script
    document.getElementById('search').addEventListener('input', function () {
        const searchTerm = this.value.trim(); // Get the input value
        const listItems = document.querySelectorAll('#dateList li'); // Get all list items

        for (let i = 0; i < listItems.length; i++) {
            const date = listItems[i].textContent.trim();

            if (date.startsWith(searchTerm)) {
                // Scroll to the matching date if the input matches the start of the date
                listItems[i].scrollIntoView({ behavior: 'smooth', block: 'center' });
                break; // Stop after finding the first match
            }
        }
    });
});
