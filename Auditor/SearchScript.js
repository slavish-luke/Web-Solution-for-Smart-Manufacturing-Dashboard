document.addEventListener('DOMContentLoaded', function () {
    const dayButton = document.getElementById('dayButton');
    const weekButton = document.getElementById('weekButton');
    const monthButton = document.getElementById('monthButton');

    // Add event listeners to each button for toggling the active class
    dayButton.addEventListener('click', () => setActiveButton(dayButton));
    weekButton.addEventListener('click', () => setActiveButton(weekButton));
    monthButton.addEventListener('click', () => setActiveButton(monthButton));

    function setActiveButton(selectedButton) {
        // Remove active class from all buttons
        dayButton.classList.remove('active');
        weekButton.classList.remove('active');
        monthButton.classList.remove('active');

        // Add active class to the selected button
        selectedButton.classList.add('active');
    }
});
