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
            </div>
            <div class="machine-statistics">


                <h2>Production count</h2>
            </div>
            <div class="machine-statistics">


                <h2>Average temperature</h2>
            </div>
            <div class="machine-statistics">


                <h2>Average speed</h2>
            </div>
        </div>
    </div>


    <div id=info>
        <div id="user"></div>
        <div id="overview"></div>
    </div>




    </div>
    <?php
        require_once "../inc/dbconn.inc.php";

        $sql = "SELECT id, machine_name, timestamp, temperature, pressure, vibration, power_consumption, operational_status, error_code, production_count, maintenance_log, speed FROM factory_logs;";

        if($result = mysqli_query($conn, $sql)){

            if(mysqli_num_rows($result) >= 1){
                
                echo "<ul>";
                while ($row = mysqli_fetch_assoc($result)) {

                    $factory_data[] = $row;
                }
                echo "</ul>";
                mysqli_free_result($result);
            }
        }
        mysqli_close($conn);

        
    ?>
    <script type="text/javascript">let rawFactoryData =<?php echo json_encode($factory_data); ?>;</script>
    <script src="script.js" defer></script>
</body>
</html>
