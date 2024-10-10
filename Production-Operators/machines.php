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
    <meta name="author" content="Olivier Griffin" />
    <meta http-equiv="Cache-control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="../Style/Production-Operators.css">
</head>
<body class="background">

    <div id="header">
        <a href="home.php">Home</a>
        <a href="machines.php" class="selected">Machines</a>
        <a href="jobs.php">Jobs</a>
        <a href="notes.php" class="last">Notes</a>
    </div>


    <div class="main" id="machines">
        <div id="machine-details">
            <div class="machine-content">

            </div>
            <div class="machine-navigation">
                <button id="return">◀ Return</button>
            </div>
        </div>
        <div id="machine-list">
            <div class="machine-content">
                <button class="machine-container" id="machine0">
                    <h2 class="machine-name">CNC Machine</h2>
                    <img src="../Style/Images/placeholder.png" class="machine-image">
                    <div class="machine-status">Operational</div>
                    <div class="machine-operator">Wallace Hunter</div>
                </button>
                <button class="machine-container" id="machine1">
                    <h2 class="machine-name">CNC Machine</h2>
                    <img src="../Style/Images/placeholder.png" class="machine-image">
                    <div class="machine-status">Operational</div>
                    <div class="machine-operator">Wallace Hunter</div>
                </button>
                <button class="machine-container" id="machine2">
                    <h2 class="machine-name">CNC Machine</h2>
                    <img src="../Style/Images/placeholder.png" class="machine-image">
                    <div class="machine-status">Operational</div>
                    <div class="machine-operator">Wallace Hunter</div>
                </button>
                <button class="machine-container" id="machine3">
                    <h2 class="machine-name">CNC Machine</h2>
                    <img src="../Style/Images/placeholder.png" class="machine-image">
                    <div class="machine-status">Operational</div>
                    <div class="machine-operator">Wallace Hunter</div>
                </button>
                <button class="machine-container" id="machine4">
                    <h2 class="machine-name">CNC Machine</h2>
                    <img src="../Style/Images/placeholder.png" class="machine-image">
                    <div class="machine-status">Operational</div>
                    <div class="machine-operator">Wallace Hunter</div>
                </button>
                <button class="machine-container" id="machine5">
                    <h2 class="machine-name">CNC Machine</h2>
                    <img src="../Style/Images/placeholder.png" class="machine-image">
                    <div class="machine-status">Operational</div>
                    <div class="machine-operator">Wallace Hunter</div>
                </button>
                <button class="machine-container" id="machine6">
                    <h2 class="machine-name">CNC Machine</h2>
                    <img src="../Style/Images/placeholder.png" class="machine-image">
                    <div class="machine-status">Operational</div>
                    <div class="machine-operator">Wallace Hunter</div>
                </button>
                <button class="machine-container" id="machine7">
                    <h2 class="machine-name">CNC Machine</h2>
                    <img src="../Style/Images/placeholder.png" class="machine-image">
                    <div class="machine-status">Operational</div>
                    <div class="machine-operator">Wallace Hunter</div>
                </button>
                <button class="machine-container" id="machine8">
                    <h2 class="machine-name">CNC Machine</h2>
                    <img src="../Style/Images/placeholder.png" class="machine-image">
                    <div class="machine-status">Operational</div>
                    <div class="machine-operator">Wallace Hunter</div>
                </button>
                <button class="machine-container" id="machine9">
                    <h2 class="machine-name">CNC Machine</h2>
                    <img src="../Style/Images/placeholder.png" class="machine-image">
                    <div class="machine-status">Operational</div>
                    <div class="machine-operator">Wallace Hunter</div>
                </button>
            </div>
            <div class="machine-navigation">
                <button class="machine-navbutton" id="prev-page">◀</button>
                <div id="current-page">1</div>
                <button class="machine-navbutton" id="next-page">▶</button>
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

            $sql = 
            "SELECT username, id 
            FROM account 
            WHERE role_id = 3";

            if($result = mysqli_query($conn, $sql)){

                if(mysqli_num_rows($result) >= 1){
                    $production_operator = [];
                    
                    while ($row = mysqli_fetch_assoc($result)) {

                        $production_operator[] = $row;
                    };
                    mysqli_free_result($result);
                }
            }
        mysqli_close($conn);


    ?>
    <script type="text/javascript">
        let rawFactoryData = <?php echo json_encode($factory_data); ?>;
        let productionOperators = <?php echo json_encode($production_operator); ?>;
    </script>
    <script src="script.js" defer></script></body>
</body>
</html>