<?php
session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || $_SESSION["userrole"] != 4){
    header("location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Luke Kradolfer" />
    <meta http-equiv="Cache-control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="../Style/Production-Operators.css">
</head>
<body>
    
    <div id="header">
        <a href="home.php" class="selected">Home</a>
        <a href="machines.php">Machines</a>
        <a href="jobs.php">Jobs</a>
        <a href="notes.php" class="last" >Notes</a>
    </div>

    <div id="home-container">
        <div id="stats">
            <h1>Statistics</h1>

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
                    <h2>Average temperature</h2>

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
                    <h2>Average speed</h2>

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


        <div id=info>
            <div id="user">
                <!--Settings Button-->
                <div>
                    <details id="settings-dropdown">
                        <summary>
                            <img src="../Style/Images/user-solid.svg" alt="" class="icons" id="user-icon">
                        </summary>

                        <h4>Settings</h4>

                        <div id="settings-content">

                            <!-- switch button from https://www.w3schools.com/howto/howto_css_switch.asp -->
                            <h5>Temperature</h5>
                            <label class="switch">
                                <span class="option-text left">&deg;C</span>
                                <input type="checkbox" id="temperature-slider">
                                <span class="slider"></span>
                                <span class="option-text right">&deg;F</span>
                            </label>
                                
                        </div>
                        
                    </details>
                </div>
                <h4><?php echo $_SESSION["username"] ?></h4>

                <!-- Haven't actually been able to test if this button works since my screen refuses to render it ;-; -->
                <a href="../logout.php"><input type="submit" id="signOutButton" value="Sign Out"></a>
            </div>
            <div id="overview">
                <h1 id="overview-header">Overview</h1>

                <div id="overview-container">
                    <div>
                        <p><b>Machines</b></p>
                    </div>

                    <div class="new-row">
                        <p>Assigned</p>
                        <p>6</p>
                    </div>

                    <div class="new-row">
                        <p>Operational</p>
                        <p>4</p>
                    </div>

                    <div class="new-row">
                        <p>Needs attention</p>
                        <p>1</p>
                    </div>

                    <div class="new-row">
                        <p>Out of order</p>
                        <p>1</p>
                    </div>
                    
                    <div class="new-row" id="last">
                        <p>Assigned Jobs</p>
                        <p>2</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    




    </div>
    <?php
        require_once "../inc/dbconn.inc.php";

        $sql = 
            "SELECT machine.id AS machine_id, machine.name AS machine_name, factory_log.*
            FROM machine 
            JOIN factory_log ON machine.id = factory_log.machine_id
            ORDER BY factory_log.timestamp DESC, machine.name;";

            if($result = mysqli_query($conn, $sql)){

                if(mysqli_num_rows($result) >= 1){
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
    <script src="script.js" defer></script>
</body>
</html>
