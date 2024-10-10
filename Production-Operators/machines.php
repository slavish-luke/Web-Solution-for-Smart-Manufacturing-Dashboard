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
                <button id="return-button">◀ Return</button>
            </div>
        </div>
        <div id="machine-list">
            <div class="machine-content">
                <button class="machine-container" id="machine0">
                    <h2 class="machine-name"></h2>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-status"></div>
                    <div class="machine-operator"></div>
                </button>
                <button class="machine-container" id="machine1">
                    <h2 class="machine-name"></h2>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-status"></div>
                    <div class="machine-operator"></div>
                </button>
                <button class="machine-container" id="machine2">
                    <h2 class="machine-name"></h2>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-status"></div>
                    <div class="machine-operator"></div>
                </button>
                <button class="machine-container" id="machine3">
                    <h2 class="machine-name"></h2>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-status"></div>
                    <div class="machine-operator"></div>
                </button>
                <button class="machine-container" id="machine4">
                    <h2 class="machine-name"></h2>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-status"></div>
                    <div class="machine-operator"></div>
                </button>
                <button class="machine-container" id="machine5">
                    <h2 class="machine-name"></h2>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-status"></div>
                    <div class="machine-operator"></div>
                </button>
                <button class="machine-container" id="machine6">
                    <h2 class="machine-name"></h2>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-status"></div>
                    <div class="machine-operator"></div>
                </button>
                <button class="machine-container" id="machine7">
                    <h2 class="machine-name"></h2>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-status"></div>
                    <div class="machine-operator"></div>
                </button>
                <button class="machine-container" id="machine8">
                    <h2 class="machine-name"></h2>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-status"></div>
                    <div class="machine-operator"></div>
                </button>
                <button class="machine-container" id="machine9">
                    <h2 class="machine-name"></h2>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-status"></div>
                    <div class="machine-operator"></div>
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
            "SELECT
            	m.id,
                m.name,
                m.operator_id,
                m.img_address,
                a.name AS operator_name,
                l.temperature,
                l.pressure,
                l.vibration,
                l.humidity,
                l.power_consumption,
                l.operational_status,
                l.error_code,
                l.production_count,
                l.maintenance_log,
                l.speed
            FROM machine m
            LEFT JOIN account a
            ON a.id = m.operator_id
            INNER JOIN factory_log l
            ON m.id = l.machine_id
            WHERE l.timestamp = (SELECT MAX(timestamp) FROM factory_log);";

            if($result = mysqli_query($conn, $sql)){

                if(mysqli_num_rows($result) >= 1){
                    $machines = [];
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        array_push($machines, $row);
                    }
                    mysqli_free_result($result);
                }
            }
        mysqli_close($conn);
    ?>
    <script type="text/javascript">
        let machines = <?php echo json_encode($machines); ?>;
    </script>
    <script src="script.js" defer></script></body>
</body>
</html>