document.addEventListener('DOMContentLoaded', function () {
    const dayButton = document.getElementById('dayButton');
    const weekButton = document.getElementById('weekButton');
    const monthButton = document.getElementById('monthButton');
    const dateList = document.getElementById('dateList');
    const searchInput = document.getElementById('search');

    const weeks = [
        "2024-04-01 to 2024-04-07",
        "2024-04-08 to 2024-04-14",
        "2024-04-15 to 2024-04-21",
        "2024-04-22 to 2024-04-28",
        "2024-04-29 to 2024-05-05",
        "2024-05-06 to 2024-05-12",
        "2024-05-13 to 2024-05-19",
        "2024-05-20 to 2024-05-26",
        "2024-05-27 to 2024-06-02",
        "2024-06-03 to 2024-06-09",
        "2024-06-10 to 2024-06-16",
        "2024-06-17 to 2024-06-23",
        "2024-06-24 to 2024-06-30"
    ];

    const months = [
        { name: "April", yearMonth: "2024-04" },
        { name: "May", yearMonth: "2024-05" },
        { name: "June", yearMonth: "2024-06" }
    ];

    function updateListWithWeeks() {
        dateList.innerHTML = '';
        weeks.forEach(function (week) {
            const li = document.createElement('li');
            const [startDate, endDate] = week.split(' to ');
            const formattedStartDate = new Date(startDate).toISOString().split('T')[0];
            const formattedEndDate = new Date(endDate).toISOString().split('T')[0];
            const link = document.createElement('a');
            link.href = `SummaryReport.php?start_date=${formattedStartDate}&end_date=${formattedEndDate}`;
            link.textContent = week;
            li.appendChild(link);
            dateList.appendChild(li);
        });
    }

    function updateListWithMonths() {
        dateList.innerHTML = '';
        months.forEach(function (month) {
            const li = document.createElement('li');
            const link = document.createElement('a');
            link.href = `SummaryReport.php?month=${month.yearMonth}`;
            link.textContent = month.name;
            li.appendChild(link);
            dateList.appendChild(li);
        });
    }

    function updateListWithDays() {
        dateList.innerHTML = '';
    }

    searchInput.addEventListener('input', function () {
        const filter = searchInput.value.toLowerCase();
        const listItems = dateList.getElementsByTagName('li');
        Array.from(listItems).forEach(function (item) {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    dayButton.addEventListener('click', function () {
        updateListWithDays();
        setActiveButton(dayButton);
    });

    weekButton.addEventListener('click', function () {
        updateListWithWeeks();
        setActiveButton(weekButton);
    });

    monthButton.addEventListener('click', function () {
        updateListWithMonths();
        setActiveButton(monthButton);
    });

    function setActiveButton(selectedButton) {
        dayButton.classList.remove('active');
        weekButton.classList.remove('active');
        monthButton.classList.remove('active');
        selectedButton.classList.add('active');
    }
});
