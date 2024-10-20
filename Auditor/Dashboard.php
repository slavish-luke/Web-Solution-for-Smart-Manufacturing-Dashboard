<?php
session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || $_SESSION["userrole"] != 2){
    header("location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Luke Kradolfer & Bailey Browne" />
    <meta http-equiv="Cache-control" content="no-cache">
    <link rel="stylesheet" href="../Style/Skeleton.css">
    <link rel="stylesheet" href="../Style/Auditor.css">
    <link rel="stylesheet" href="../Style/Production-Operators.css">
    <link type="image/png" sizes="16x16" rel="icon" href="../Style/Images/home-favicon.png">
</head>

<body>

    <!-- Header -->
    <header>
        <!--Home Button-->
        <div id="Home-icon-auditor">
            <a href="../Auditor/home.php">
                <img src="../Style/Images/home-button.svg" alt="home button image" id="Home-icon">
            </a>
        </div>

        <!--Welcome Message-->
        <div id="Welcome-message">
            <p>Dashboard</p>
        </div>

        <!--Settings Button-->
        <div>
            <details id="settings-dropdown">
                <summary>
                <img src="../Style/Images/settings-cog.svg" alt="Settings cog" id="Settings-icon">
                </summary>
                <a href="../logout.php">Logout</a>
            </details>
        </div>
    </header>

    <!-- Dashboard Content -->
    <div id="home-container">
        <div id="stats-container">

            <!-- Power Consumption -->
            <div class="machine-statistics">
                <h2>Power consumption</h2>
                <div class="chart-container">
                    <svg class="chart" viewBox="0 0 36 36">
                        <circle class="background" r="16" cx="18" cy="18"></circle>
                        <circle id="power-consumption-chart" class="foreground" r="16" cx="18" cy="18" stroke-dasharray="50 100" transform="rotate(-90 18 18)"></circle>
                    </svg>
                    <div class="display-stats" id="power-consumption">2841</div>
                </div>
            </div>

            <!-- Production Count -->
            <div class="machine-statistics">
                <h2>Production count</h2>
                <div class="chart-container">
                    <svg class="chart" viewBox="0 0 36 36">
                        <circle class="background" r="16" cx="18" cy="18"></circle>
                        <circle id="production-count-chart" class="foreground" r="16" cx="18" cy="18" stroke-dasharray="75 100" transform="rotate(-90 18 18)"></circle>
                    </svg>
                    <div class="display-stats" id="production-count">573</div>
                </div>
            </div>

            <!-- Average Temperature with Celsius/Fahrenheit Toggle -->
            <div class="machine-statistics">
                <h2>Average temperature</h2>
                <div class="chart-container">
                    <svg class="chart" viewBox="0 0 36 36">
                        <circle class="background" r="16" cx="18" cy="18"></circle>
                        <circle id="average-temperature-chart" class="foreground" r="16" cx="18" cy="18" stroke-dasharray="65 100" transform="rotate(-90 18 18)"></circle>
                    </svg>
                    <div class="display-stats" id="average-temperature">54.2°C</div>
                </div>
            </div>

            <!-- Average Speed -->
            <div class="machine-statistics">
                <h2>Average speed</h2>
                <div class="chart-container">
                    <svg class="chart" viewBox="0 0 36 36">
                        <circle class="background" r="16" cx="18" cy="18"></circle>
                        <circle id="average-speed-chart" class="foreground" r="16" cx="18" cy="18" stroke-dasharray="30 100" transform="rotate(-90 18 18)"></circle>
                    </svg>
                    <div class="display-stats" id="average-speed">1.43 m/s</div>
                </div>
            </div>

        </div>
    </div>

    <!-- PHP and Data Handling -->
    <?php
        require_once "../inc/dbconn.inc.php";

        // Query for factory log data
        $sql = "SELECT machine.id AS machine_id, machine.name AS machine_name, factory_log.*
                FROM machine 
                JOIN factory_log ON machine.id = factory_log.machine_id
                ORDER BY factory_log.timestamp DESC, machine.name;";

        if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) >= 1) {
                $factory_data = [];

                while ($row = mysqli_fetch_assoc($result)) {
                    $factory_data[$row['machine_id']]['machine_name'] = $row['machine_name'];
                    $factory_data[$row['machine_id']]['logs'][] = [
                        'timestamp' => $row['timestamp'],
                        'operational_status' => $row['operational_status'],
                        'error_code' => $row['error_code'],
                        'maintenance_log' => $row['maintenance_log'],
                        'power_consumption' => $row['power_consumption'],
                        'temperature' => $row['temperature'],
                        'production_count' => $row['production_count'],
                        'speed' => $row['speed'],
                        'pressure' => $row['pressure'],
                        'vibration' => $row['vibration'],
                        'humidity' => $row['humidity']
                    ];
                }
                mysqli_free_result($result);
            }
        }

        // Query for task data
        $sql = "SELECT t.id, t.machine_id FROM task t LEFT JOIN machine m ON t.machine_id = m.id WHERE t.operator_id = " . $_SESSION["userid"];
        if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) >= 1) {
                $tasks = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($tasks, $row);
                }
                mysqli_free_result($result);
            }
        }

        // Query for machine data
        $sql = "SELECT m.*, a.name AS operator_name FROM machine m LEFT JOIN account a ON a.id = m.operator_id";
        if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) >= 1) {
                $machines = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($machines, $row);
                }
                mysqli_free_result($result);
            }
        }

        mysqli_close($conn);
    ?>

    <!-- Pass Data to JS -->
    <script type="text/javascript">
        let rawFactoryData = <?php echo json_encode($factory_data); ?>;
        let tasks = <?php echo json_encode($tasks); ?>;
        let machines = <?php echo json_encode($machines); ?>;
    </script>
    <script src="../Production-Operators/script.js" defer></script>

</body>
</html>
