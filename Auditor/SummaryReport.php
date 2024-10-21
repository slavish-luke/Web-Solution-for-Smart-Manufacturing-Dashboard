<?php
session_start();
require_once '../inc/dbconn.inc.php';

$singleDate = isset($_GET['date']) ? $_GET['date'] : null;
$weekStart = isset($_GET['week_start']) ? $_GET['week_start'] : null;
$weekEnd = isset($_GET['week_end']) ? $_GET['week_end'] : null;
$month = isset($_GET['month']) ? $_GET['month'] : null;

if ($singleDate) {
    $selectedRange = $singleDate;
    $query = "SELECT 
        AVG(temperature) AS  avg_temperature,
        AVG(pressure) AS avg_pressure,
        AVG(vibration) AS avg_vibration,
        AVG(humidity) AS avg_humidity,
        AVG(power_consumption) AS avg_power_consumption,
        AVG(production_count) AS avg_production_count,
        AVG(speed) AS avg_speed

        FROM factory_log 
        WHERE timestamp BETWEEN '$singleDate 00:00:00' AND '$singleDate 23:59:59'";

} elseif ($weekStart && $weekEnd) {
    $selectedRange = "$weekStart to $weekEnd";
    $query = "SELECT 
        AVG(temperature) AS avg_temperature,
        AVG(pressure) AS avg_pressure,
        AVG(vibration) AS avg_vibration,
        AVG(humidity) AS avg_humidity,
        AVG(power_consumption) AS avg_power_consumption,
        AVG(production_count) AS avg_production_count,
        AVG(speed) AS avg_speed

        FROM factory_log 
        WHERE timestamp BETWEEN '$weekStart 00:00:00' AND '$weekEnd 23:59:59'";

} elseif ($month) {
    $selectedRange = date('F Y', strtotime($month));
    $query = "SELECT 
        AVG(temperature) AS avg_temperature,
        AVG(pressure) AS avg_pressure,
        AVG(vibration) AS  avg_vibration,
        AVG(humidity) AS avg_humidity,
        AVG(power_consumption) AS avg_power_consumption,
        AVG(production_count) AS avg_production_count,
        AVG(speed) AS avg_speed

        FROM factory_log 
        WHERE timestamp BETWEEN '$month-01 00:00:00' AND LAST_DAY('$month-01 23:59:59')";

} else {
    $selectedRange = 'Invalid date';
    $query = null;
}

$result = $query ? $conn->query($query) : null;

$avgTemperature = $avgPressure = $avgVibration = $avgHumidity = $avgPowerConsumption = $avgProductionCount = $avgSpeed = 'N/A';

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

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/Skeleton.css">
    <link rel="stylesheet" href="../Style/Auditor.css">
    <title>Summary Report for <?php echo htmlspecialchars($selectedRange); ?></title>
</head>
<body>

<header>
    <div id="Home-icon-auditor">
        <a href="../Auditor/home.php">
            <img src="../Style/Images/home-button.svg" alt="home button image" id="Home-icon">
        </a>
    </div>

    <div id="Welcome-message">
        <h1><?php echo htmlspecialchars($selectedRange); ?></h1>
    </div>

    <div>
        <details id="settings-dropdown">
            <summary>
                <img src="../Style/Images/settings-cog.svg" alt="Settings cog" id="Settings-icon">
            </summary>
            <a href="../logout.php">Logout</a>
        </details>
    </div>
</header>

<div class="content">
    <div class="metrics">
        <p><b>Average Temperature:</b> <?php echo $avgTemperature; ?> °C</p>
        <p><b>Average Pressure:</b> <?php echo $avgPressure; ?>  Pa</p>
        <!-- 
        <p><b>Average Pressure:</b> <?php //echo $avgPressure; ?> kPa</p>
        Chat GPT -4
        Prompt
        What is the correct unit of pressure 

        Response 
        The correct unit of pressure depends on the system of measurement you're using:
        SI (International System of Units):
        Pascal (Pa) is the standard unit of pressure in the SI system.
        1 Pascal = 1 Newton per square meter (N/m²).

        Interpretation
        use Pascals (Pa)
        -->

        <p><b>Average Vibration:</b> <?php echo $avgVibration; ?> mm/s</p>
        <p><b>Average Humidity:</b> <?php echo $avgHumidity; ?> %</p>
        <p><b>Average Power Consumption:</b> <?php echo $avgPowerConsumption; ?> kWh</p>
        <p><b>Average Production Count:</b> <?php echo $avgProductionCount; ?></p>
        <p><b>Average Speed:</b> <?php echo $avgSpeed; ?> m/s</p>
    </div>
</div>

</body>
</html>
