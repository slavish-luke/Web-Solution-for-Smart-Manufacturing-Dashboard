<?php
// Database connection parameters
$servername = "localhost";
$username = "root";  // MySQL default username for XAMPP
$password = "";  // Default root password for XAMPP
$dbname = "smart_manufacturing_dashboard";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve date-related data from the database based on day/week/month selection
$type = $_GET['type'] ?? 'day';

$sql = "SELECT DISTINCT DATE(timestamp) as date FROM factory_log ORDER BY date ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $dates = [];
    while ($row = $result->fetch_assoc()) {
        $dates[] = $row['date'];
    }

    if ($type == 'week') {
        // Display weeks by grouping dates in 7-day ranges
        $weekStart = null;
        $i = 0; // Counter for 7-day interval
    
        foreach ($dates as $index => $date) {
            if ($weekStart === null) {
                // First date in the week range
                $weekStart = $date;
            }
    
            // Calculate the end of the current week
            $weekEnd = date('Y-m-d', strtotime($weekStart . ' +6 days'));
    
            if (++$i == 7 || $index == count($dates) - 1) {
                // End of the week or end of the dates array
                echo "<li><a href='SummaryReport.php?week_start=$weekStart&week_end=$weekEnd'>$weekStart to $weekEnd</a></li>";
                // Reset for the next week
                $weekStart = null;
                $i = 0; // Reset the counter
            }
        }
    } elseif ($type == 'day') {
        // Display individual days
        foreach ($dates as $date) {
            echo "<li><a href='SummaryReport.php?date=$date'>$date</a></li>";
        }
    } elseif ($type == 'month') {
        // Display months
        $currentMonth = '';
        foreach ($dates as $date) {
            $month = date('F Y', strtotime($date));
            if ($month !== $currentMonth) {
                echo "<li><a href='SummaryReport.php?month=" . date('Y-m', strtotime($date)) . "'>$month</a></li>";
                $currentMonth = $month;
            }
        }
    }
} else {
    echo "No records found.";
}

$conn->close();
?>
