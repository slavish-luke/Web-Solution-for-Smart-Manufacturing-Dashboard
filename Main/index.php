<!DOCTYPE html>
<html lang="en">
<head>
    <title>factorylogs test</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Luke Kradolfer" />
</head>
<body>
    <h1>Machine names</h1>

    <div id="machine_names">

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
    <script src="../scripts/script.js" defer></script>
</body>
</html>
