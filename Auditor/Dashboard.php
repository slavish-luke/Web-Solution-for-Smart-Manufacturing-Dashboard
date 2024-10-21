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
            <div class="machine-statistics">
                <h2>Power consumption</h2>
                <div class="chart-container">
                    <svg class="chart" viewBox="0 0 36 36">
                        <circle class="background" r="16" cx="18" cy="18"></circle>
                        <circle id="power-consumption-chart" class="foreground" r="16" cx="18" cy="18" stroke-dasharray="0 100" transform="rotate(-90 18 18)"></circle>
                    </svg>
                </div>

                <div class="display-stats">
                    <h3 id="power-consumption"></h3>
                </div>
            </div>

            <div class="machine-statistics">
                <h2>Production count</h2>

               <div class="chart-container">
                    <svg class="chart" viewBox="0 0 36 36">
                        <circle class="background" r="16" cx="18" cy="18"></circle>
                        <circle id="production-count-chart" class="foreground" r="16" cx="18" cy="18" stroke-dasharray="0 100" transform="rotate(-90 18 18)"></circle>
                    </svg>
                </div>

                <div class="display-stats">
                    <h3 id="production-count"></h3>
                </div>
            </div>
            
            <div class="machine-statistics">
                <h2 class="h2-bottom">Average temperature</h2>

                <div class="chart-container">
                    <svg class="chart" viewBox="0 0 36 36">
                        <circle class="background" r="16" cx="18" cy="18"></circle>
                        <circle id="average-temperature-chart" class="foreground" r="16" cx="18" cy="18" stroke-dasharray="0 100" transform="rotate(-90 18 18)"></circle>
                    </svg>
                </div>
                    
               <div class="display-stats">
                    <h3 id="average-temperature"></h3>
                </div>

            </div>


            <div class="machine-statistics">
                <h2 class="h2-bottom">Average speed</h2>

                <div class="chart-container">
                    <svg class="chart" viewBox="0 0 36 36">
                        <circle class="background" r="16" cx="18" cy="18"></circle>
                        <circle id="average-speed-chart" class="foreground" r="16" cx="18" cy="18" stroke-dasharray="18.55 100" transform="rotate(-90 18 18)"></circle>
                    </svg>
                </div>

                <div class="display-stats">
                    <h3 id="average-speed"></h3>
                </div>
            </div>
        </div>
    </div>


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
        mysqli_close($conn);
    ?>
    <script type="text/javascript">let rawFactoryData = <?php echo json_encode($factory_data); ?>;</script>
    <script src="../Factory-Managers/scripts.js" defer></script>
    <script src="../Factory-Managers/piecharts.js" defer></script>

</body>
</html>
