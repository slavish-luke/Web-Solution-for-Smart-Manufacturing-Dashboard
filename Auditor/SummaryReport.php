<?php
session_start();


// Database connection
require_once '../inc/dbconn.inc.php';

// Get the selected date from the URL parameters
$selectedDate = isset($_GET['date']) ? $_GET['date'] : '';

// SQL query to retrieve all logs for the selected date
$query = "SELECT timestamp, temperature FROM factory_log WHERE timestamp BETWEEN '$selectedDate 00:00:00' AND '$selectedDate 23:59:59'";

// HTML structure
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/Skeleton.css">
    <link rel="stylesheet" href="../Style/Auditor.css">
    <title>Summary Report</title>
</head>
<body>
<header>
    <!-- Home Icon -->
    <div>
        <a href="../Auditor/home.php">
            <img src="../Style/Images/home-button.svg" alt="home button" id="Home-icon">
        </a>
    </div>

    <!-- Welcome Message -->
    <div id="Welcome-message">
        Summary Report for <?php echo htmlspecialchars($selectedDate); ?>
    </div>

    <!-- Settings Button -->
    <div>
        <img src="../Style/Images/settings-cog.svg" alt="Settings cog" id="Settings-icon">
    </div>
</header>

<div class="content">
    <?php
    // Execute the query and fetch the results
    if ($result = $conn->query($query)) {
        echo "<pre>Fetched Rows:<br>";
        echo "Query executed: " . $query . "<br>";  // Debugging line to show the executed query
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Time: " . date('H:i:s', strtotime($row['timestamp'])) . " - Temperature: " . $row['temperature'] . "°C<br>";
            }
        } else {
            echo "No temperatures found for the selected date.";
        }
        echo "</pre>";
    } else {
        echo "Error fetching data: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
    ?>
</div>

</body>
</html>
