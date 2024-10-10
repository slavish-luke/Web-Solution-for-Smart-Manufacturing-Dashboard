<?php
require_once '../inc/dbconn.inc.php';

// Get the selected date from the URL parameters
$selectedDate = isset($_GET['date']) ? $_GET['date'] : '';

// SQL query to retrieve the averages for each metric for the selected date
$query = "SELECT 
    AVG(temperature) AS avg_temperature,
    AVG(pressure) AS avg_pressure,
    AVG(vibration) AS avg_vibration,
    AVG(humidity) AS avg_humidity,
    AVG(power_consumption) AS avg_power_consumption,
    AVG(production_count) AS avg_production_count,
    AVG(speed) AS avg_speed
    FROM factory_log 
    WHERE timestamp BETWEEN '$selectedDate 00:00:00' AND '$selectedDate 23:59:59'";

// Execute the query
$result = $conn->query($query);

// Initialize variables to store averages
$avgTemperature = $avgPressure = $avgVibration = $avgHumidity = $avgPowerConsumption = $avgProductionCount = $avgSpeed = 'N/A';

// Check if results are returned
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $avgTemperature = number_format($row['avg_temperature'], 2);
    $avgPressure = number_format($row['avg_pressure'], 2);
    $avgVibration = number_format($row['avg_vibration'], 2);
    $avgHumidity = number_format($row['avg_humidity'], 2);
    $avgPowerConsumption = number_format($row['avg_power_consumption'], 2);
    $avgProductionCount = number_format($row['avg_production_count'], 2);
    $avgSpeed = number_format($row['avg_speed'], 2);
}

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
    <style>
    .content {
        display: flex;
        justify-content: center; 
        align-items: flex-start; 
        flex-direction: column;
        padding-top: 40px; 
        font-size: 28px;
        text-align: center; 
        font-family: 'Courier New', Courier, monospace; 
        width: fit-content; 
        margin: 0 auto;
    }

    .metrics p {
        margin: 15px 0; 
        font-size: 32px;
        font-weight: bold; 
    }
</style>

</head>
<body>
<header>
    <!-- Home Icon -->
    <div>
        <a href="../Auditor/home.php">
            <img src="../Style/Images/home-button.svg" alt="home button" id="Home-icon">
        </a>
    </div>

    <!-- Date as Welcome Message -->
    <div id="Welcome-message">
        <h1><?php echo htmlspecialchars($selectedDate); ?></h1>
    </div>

    <!-- Settings Button -->
    <div>
        <img src="../Style/Images/settings-cog.svg" alt="Settings cog" id="Settings-icon">
    </div>
</header>

<div class="content">
    <div class="metrics">
        <p><b>Average Temperature:</b> <?php echo $avgTemperature; ?> °C</p>
        <p><b>Average Pressure:</b> <?php echo $avgPressure; ?> kPa</p>
        <p><b>Average Vibration:</b> <?php echo $avgVibration; ?> mm/s</p>
        <p><b>Average Humidity:</b> <?php echo $avgHumidity; ?> %</p>
        <p><b>Average Power Consumption:</b> <?php echo $avgPowerConsumption; ?> kWh</p>
        <p><b>Average Production Count:</b> <?php echo $avgProductionCount; ?></p>
        <p><b>Average Speed:</b> <?php echo $avgSpeed; ?> m/s</p>
    </div>
</div>

<?php
// Close the database connection
$conn->close();
?>

</body>
</html>
