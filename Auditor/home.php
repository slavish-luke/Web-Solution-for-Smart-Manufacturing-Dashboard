<?php
// Database connection details
$host = 'localhost';
$user = 'dbadmin';
$password = '';
$database = 'smart_manufacturing_dashboard';

// Create a connection
$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch distinct dates from the factory_log table
$sql = "SELECT DISTINCT DATE(timestamp) as date FROM factory_log ORDER BY date ASC";
$result = $conn->query($sql);

// Close the connection after fetching the data
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/Skeleton.css">
    <link rel="stylesheet" href="../Style/Auditor.css">
    <title>HomePage</title>
</head>

<header>
    <!-- Home Button -->
    <div id="Home-icon-auditor">
        <a href="../Auditor/home.php">
            <img src="../Style/Images/home-button.svg" alt="home button" id="Home-icon">
        </a>
    </div>

    <!-- Welcome Message -->
    <div id="Welcome-message">
        <p>Welcome <?php session_start(); echo $_SESSION['username']; ?></p>
    </div>

    <!-- Settings Button -->
    <div>
        <details id="settings-dropdown">
            <summary>
                <img src="../Style/Images/settings-cog.svg" alt="Settings" id="Settings-icon">
            </summary>
            <a href="../logout.php">Logout</a>
        </details>
    </div>
</header>

<body>
    <div id="Dashboard">
        <a href="../Auditor/Dashboard.php">
            <h1>Dashboard</h1>
        </a>
    </div>

    <div id="SummaryReports">
        <h1>Summary Reports</h1>

        <!-- Button Selection: Day, Week, Month -->
        <div class="select-container">
            <button class="select-option active" id="dayButton">Day</button>
            <button class="select-option" id="weekButton">Week</button>
            <button class="select-option" id="monthButton">Month</button>
        </div>

        <!-- Search Bar -->
        <div id="SearchBar">
            <input type="text" id="search" placeholder="Search">
        </div>

        <!-- Report List -->
        <div id="ReportList">
            <ul id="dateList">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<li><a href="SummaryReport.php?date=' . $row['date'] . '">' . $row['date'] . '</a></li>';
                    }

                    /* 
                    while ($row = $result->fetch_asoc()) {*= 
                        echo '<li><a href="SummaryReport.php?date=' . $row['date'] . '">' . $row['date'] . '</a></li>';
                    }

                    Chat GPT -4
                    Prompt
                    Can you help me figure out the error in this code it's supposed to be calling information from another script and adding it to a list.
                    while ($row = $result->fetch_asoc()) {
                        echo '<li><a href="SummaryReport.php?date=' . $row['date'] . '">' . $row['date'] . '</a></li>';
                    }

                    Response 
                    The error in your code is likely due to a typo in the method name fetch_asoc(). The correct method name is fetch_assoc(). Here's the corrected code:
                    while ($row = $result->fetch_assoc()) {
                        echo '<li><a href="SummaryReport.php?date=' . $row['date'] . '">' . $row['date'] . '</a></li>';
                    }

                    Interpretation
                    I need to fix a syntax error when calling it
                    */

                } else {
                    echo '<li>No reports available</li>';
                }
                ?>
            </ul>
        </div>
    </div>

    <script src="Script.js"></script>
</body>
</html>
