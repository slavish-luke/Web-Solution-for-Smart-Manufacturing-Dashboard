<?php
session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]){
    header("location: ../login.php");
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
            <img src="../Style/Images/user-solid.svg" alt="" class="icons" id="user-icon">
            <h4>John Doe</h4>

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
    <?php
        require_once "../inc/dbconn.inc.php";

        $sql = "SELECT id, machine_name, timestamp, temperature, pressure, vibration, power_consumption, operational_status, error_code, production_count, maintenance_log, speed FROM factory_logs;";

        if($result = mysqli_query($conn, $sql)){

            if(mysqli_num_rows($result) >= 1){
                
                while ($row = mysqli_fetch_assoc($result)) {

                    $factory_data[] = $row;
                }
                mysqli_free_result($result);
            }
        }
        mysqli_close($conn);

        
    ?>
    <script type="text/javascript">let rawFactoryData =<?php echo json_encode($factory_data); ?>;</script>
    <script src="script.js" defer></script>
</body>
</html>
