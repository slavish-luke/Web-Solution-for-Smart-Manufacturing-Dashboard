<?php
// Database connection parameters
$servername = "localhost";
$username = "root";  // MySQL default username for XAMPP
$password = "";  // Default root password for XAMPP
$dbname = "smart_manufacturing_dashboard";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type = $_GET['type'] ?? 'day';

$sql = "SELECT DISTINCT DATE(timestamp) as date FROM factory_log ORDER BY date ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $dates = [];
    while ($row = $result->fetch_assoc()) {
        $dates[] = $row['date'];
    }

    if ($type == 'week') {
        $weekStart = null;
        $i = 0; 
    
        foreach ($dates as $index => $date) {
            if ($weekStart === null) {
                $weekStart = $date;
            }
    
            $weekEnd = date('Y-m-d', strtotime($weekStart . ' +6 days'));
    
            if (++$i == 7 || $index == count($dates) - 1) {
                echo "<li><a href='SummaryReport.php?week_start=$weekStart&week_end=$weekEnd'>$weekStart to $weekEnd</a></li>";
                $weekStart = null;
                $i = 0; 

                /*
                echo "<li><a href='SummaryReport.php?week_start=$weekStart&week_end=$weekEnd'>$weekStart to $weekEnd</a></li>";
                $weekStart = null;

                Chat GPT -4
                Prompt
                Why are only the first two weeks showing up on the list 
                if (++$i == 7 || $index == count($dates) - 1) {
                echo "<li><a href='SummaryReport.php?week_start=$weekStart&week_end=$weekEnd'>$weekStart to $weekEnd</a></li>";
                $weekStart = null;
                }

                Response 
                Ensure that $i is properly reset after each week. Here's a corrected version:
                if ($i == 7 || $index == count($dates) - 1) {
                // Output the list item for the week
                echo "<li><a href='SummaryReport.php?week_start=$weekStart&week_end=$weekEnd'>$weekStart to $weekEnd</a></li>";
        
                // Reset $i and $weekStart for the next week
                $i = 0;
                $weekStart = null;
                }

                Interpretation 
                Reset i value
                */
            }
        }
    } elseif ($type == 'day') {
        foreach ($dates as $date) {
            echo "<li><a href='SummaryReport.php?date=$date'>$date</a></li>";
        }
    } elseif ($type == 'month') {
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
    echo "No Information";
}

$conn->close();
?>
