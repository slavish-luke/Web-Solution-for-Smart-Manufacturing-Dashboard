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
                <div>
                    <h1>Name</h1>
                    <img>
                </div>
                <div>
                    <span>Operator</span>
                    <span>Status</span>
                    <span>Error Code</span>
                    <span>Log</span>
                    <span>Temp</span>
                    <span>Pressure</span>
                    <span>Vibration</span>
                    <span>Humidity</span>
                    <span>Power</span>
                    <span>Count</span>
                    <span>Speed</span>
                </div>
            </div>
            <div class="machine-navigation">
                <button class="machine-navbutton" id="return-button">◀ Return</button>
            </div>
        </div>
        <div id="machine-list">
            <div class="machine-content">
                <button class="machine-container" id="machine0">
                    <h3 class="machine-name"></h3>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-attribute machine-status">
                        <img src="../Style/Images/idle.svg">
                    </div>
                    <div class="machine-attribute machine-operator">
                        <img src="../Style/Images/user-solid.svg">
                    </div>
                </button>
                <button class="machine-container" id="machine1">
                    <h3 class="machine-name"></h3>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-attribute machine-status">
                        <img src="../Style/Images/idle.svg">
                    </div>
                    <div class="machine-attribute machine-operator">
                        <img src="../Style/Images/user-solid.svg">
                    </div>
                </button>
                <button class="machine-container" id="machine2">
                    <h3 class="machine-name"></h3>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-attribute machine-status">
                        <img src="../Style/Images/idle.svg">
                    </div>
                    <div class="machine-attribute machine-operator">
                        <img src="../Style/Images/user-solid.svg">
                    </div>
                </button>
                <button class="machine-container" id="machine3">
                    <h3 class="machine-name"></h3>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-attribute machine-status">
                        <img src="../Style/Images/idle.svg">
                    </div>
                    <div class="machine-attribute machine-operator">
                        <img src="../Style/Images/user-solid.svg">
                    </div>
                </button>
                <button class="machine-container" id="machine4">
                    <h3 class="machine-name"></h3>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-attribute machine-status">
                        <img src="../Style/Images/idle.svg">
                    </div>
                    <div class="machine-attribute machine-operator">
                        <img src="../Style/Images/user-solid.svg">
                    </div>
                </button>
                <button class="machine-container" id="machine5">
                    <h3 class="machine-name"></h3>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-attribute machine-status">
                        <img src="../Style/Images/idle.svg">
                    </div>
                    <div class="machine-attribute machine-operator">
                        <img src="../Style/Images/user-solid.svg">
                    </div>
                </button>
                <button class="machine-container" id="machine6">
                    <h3 class="machine-name"></h3>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-attribute machine-status">
                        <img src="../Style/Images/idle.svg">
                    </div>
                    <div class="machine-attribute machine-operator">
                        <img src="../Style/Images/user-solid.svg">
                    </div>
                </button>
                <button class="machine-container" id="machine7">
                    <h3 class="machine-name"></h3>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-attribute machine-status">
                        <img src="../Style/Images/idle.svg">
                    </div>
                    <div class="machine-attribute machine-operator">
                        <img src="../Style/Images/user-solid.svg">
                    </div>
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

        $sql = "SELECT m.*, a.name AS operator_name FROM machine m LEFT JOIN account a ON a.id = m.operator_id";

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