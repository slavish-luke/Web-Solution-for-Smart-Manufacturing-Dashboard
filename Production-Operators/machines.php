<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="UTF-8" />
    <meta name="author" content="" />
    <meta http-equiv="Cache-control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="../Style/Production-Operators.css">
</head>
<body>
    
    <div id="header">
        <a href="home.php">Home</a>
        <a href="machines.php">Machines</a>
        <a href="jobs.php">Jobs</a>
        <a href="notes.php">Notes</a>
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
