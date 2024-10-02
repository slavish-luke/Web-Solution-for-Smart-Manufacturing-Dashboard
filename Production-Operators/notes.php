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
        <a href="home.php">Home</a>
        <a href="machines.php">Machines</a>
        <a href="jobs.php">Jobs</a>
        <a href="notes.php" class="last selected">Notes</a>
    </div>


    <div class="main" id="notes">
        <h1>Task Notes</h1>
        <form action="" method="post">
            <!-- <label for="machines">Pick machine</label>
            <select name="machines" id="machineDropDown" selected="choose" required></select> -->

            <div id="checklist-container"></div>
            

            <input type="text" name="taskName" placeholder="Enter the task name" required/>
            <input type="submit" value="Add Task"/>
        </form>
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
    <script src="script.js" defer></script></body>
</html>
