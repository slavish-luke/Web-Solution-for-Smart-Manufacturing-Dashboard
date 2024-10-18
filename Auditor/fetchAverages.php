<?php
require_once '../inc/dbconn.inc.php';  // Include your database connection

$startDate = $_GET['start_date'] ?? null;
$endDate = $_GET['end_date'] ?? null;

if ($startDate && $endDate) {
    // Query to calculate weekly averages
    $query = "SELECT 
        AVG(temperature) AS avg_temperature,
        AVG(pressure) AS avg_pressure,
        AVG(vibration) AS avg_vibration,
        AVG(humidity) AS avg_humidity,
        AVG(power_consumption) AS avg_power_consumption,
        AVG(production_count) AS avg_production_count,
        AVG(speed) AS avg_speed
        FROM factory_log 
        WHERE timestamp BETWEEN '$startDate 00:00:00' AND '$endDate 23:59:59'";

    $result = $conn->query($query);
    $averages = [];

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $averages = [
            'avgTemperature' => number_format($row['avg_temperature'], 2),
            'avgPressure' => number_format($row['avg_pressure'], 2),
            'avgVibration' => number_format($row['avg_vibration'], 2),
            'avgHumidity' => number_format($row['avg_humidity'], 2),
            'avgPowerConsumption' => number_format($row['avg_power_consumption'], 2),
            'avgProductionCount' => number_format($row['avg_production_count'], 2),
            'avgSpeed' => number_format($row['avg_speed'], 2)
        ];
    }

    // Send the averages as a JSON response
    echo json_encode($averages);
} else {
    echo json_encode([
        'error' => 'Invalid date range.'
    ]);
}

$conn->close();
?>
