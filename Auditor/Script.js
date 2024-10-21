document.getElementById('dayButton').addEventListener('click', function () {
    loadDates('day');
    setActiveButton('dayButton');
});

document.getElementById('weekButton').addEventListener('click', function () {
    loadDates('week');
    setActiveButton('weekButton');
});

document.getElementById('monthButton').addEventListener('click', function () {
    loadDates('month');
    setActiveButton('monthButton');
});

document.getElementById('search').addEventListener('input', function (e) {
    const filter = e.target.value.toLowerCase();
    document.querySelectorAll('#dateList li').forEach(item => {
        item.style.display = item.textContent.toLowerCase().includes(filter) ? '' : 'none';
    });

    /*
    const filter = e.target.value.toLowerCase();
    document.querySelectorAll('#dateList li').forEach(item => {
        item.style.display = item.textCntent.toLowerCase().includes(filter) ? '' : 'none';
    });

    Chat GPT -4
    Prompt
    why isn't the search function written below working?
        const filter = e.target.value.toLowerCase();
    document.querySelectorAll('#dateList li').forEach(item => {
        item.style.display = item.textCntent.toLowerCase().includes(filter) ? '' : 'none';
    });

    Response 
    The issue in your search function is due to a typo in the property name textCntent. It should be textContent. This typo prevents the function from accessing the text inside the list items correctly.

    Here’s the corrected code:

    const filter = e.target.value.toLowerCase();
    document.querySelectorAll('#dateList li').forEach(item => {
        item.style.display = item.textContent.toLowerCase().includes(filter) ? '' : 'none';
    });

    Interpretation
    "context is missing a o"
    */
});

function loadDates(dateType) {
    fetch(`load-Dates.php?type=${dateType}`)
        .then(response => response.ok ? response.text() : Promise.reject('Failed to load dates'))
        .then(data => document.getElementById('dateList').innerHTML = data)
        .catch(error => console.error(error));
}

function setActiveButton(activeId) {
    ['dayButton', 'weekButton', 'monthButton'].forEach(id => {
        document.getElementById(id).classList.toggle('active', id === activeId);
    });
}
