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
            <div id="status-modal" class="modal">
                <div class="modal-content">
                    <span id="close-status" class="close">&times;</span>
                    <form method="POST" action="update-machine.php">
                        <input type="hidden" name="id" value="0" id="update-machine-id">
                        <input type="submit" name="status" value="active" class="status-option"><br>
                        <input type="submit" name="status" value="idle" class="status-option"><br>
                        <input type="submit" name="status" value="maintenance" class="status-option"><br>
                    </form>
                </div>
            </div>
            <div class="content-pane">
                <div id="machine-display" style="float: left; width: 50%;">
                    <h1 id="machine-name">Name</h1>
                    <img id="machine-image">
                </div>
                <div id="machine-stats" style="float: right; width: 50%;">
                    <div class="machine-stat">
                        Status:
                        <span id="machine-status"></span>
                        <button id="change-status">Update</button>
                    </div>
                    <div class="machine-stat">Error Code: <span id="machine-error-code"></span></div>
                    <div class="machine-stat">Log: <span id="machine-log"></span></div>
                    <div class="machine-stat">Operator: <span id="machine-operator"></span></div>
                    <div class="machine-stat">Temp: <span id="machine-temp"></span></div>
                    <div class="machine-stat">Pressure: <span id="machine-pressure"></span></div>
                    <div class="machine-stat">Vibration: <span id="machine-vibration"></span></div>
                    <div class="machine-stat">Humidity: <span id="machine-humidity"></span></div>
                    <div class="machine-stat">Power: <span id="machine-power"></span></div>
                    <div class="machine-stat">Count: <span id="machine-count"></span></div>
                    <div class="machine-stat">Speed: <span id="machine-speed"></span></div>
                </div>
            </div>
            <div class="navigation-pane">
                <button class="navbutton" id="return-button">◀ Return</button>
            </div>
        </div>
        <div id="machine-list">
            <div class="content-pane">
                <button class="machine-container" id="machine0">
                    <h3 class="machine-name"></h3>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-attribute machine-status">
                        <img src="../Style/Images/idle.svg"><span></span>
                    </div>
                    <div class="machine-attribute machine-operator">
                        <img src="../Style/Images/user-solid.svg"><span></span>
                    </div>
                </button>
                <button class="machine-container" id="machine1">
                    <h3 class="machine-name"></h3>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-attribute machine-status">
                        <img src="../Style/Images/idle.svg"><span></span>
                    </div>
                    <div class="machine-attribute machine-operator">
                        <img src="../Style/Images/user-solid.svg"><span></span>
                    </div>
                </button>
                <button class="machine-container" id="machine2">
                    <h3 class="machine-name"></h3>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-attribute machine-status">
                        <img src="../Style/Images/idle.svg"><span></span>
                    </div>
                    <div class="machine-attribute machine-operator">
                        <img src="../Style/Images/user-solid.svg"><span></span>
                    </div>
                </button>
                <button class="machine-container" id="machine3">
                    <h3 class="machine-name"></h3>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-attribute machine-status">
                        <img src="../Style/Images/idle.svg"><span></span>
                    </div>
                    <div class="machine-attribute machine-operator">
                        <img src="../Style/Images/user-solid.svg"><span></span>
                    </div>
                </button>
                <button class="machine-container" id="machine4">
                    <h3 class="machine-name"></h3>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-attribute machine-status">
                        <img src="../Style/Images/idle.svg"><span></span>
                    </div>
                    <div class="machine-attribute machine-operator">
                        <img src="../Style/Images/user-solid.svg"><span></span>
                    </div>
                </button>
                <button class="machine-container" id="machine5">
                    <h3 class="machine-name"></h3>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-attribute machine-status">
                        <img src="../Style/Images/idle.svg"><span></span>
                    </div>
                    <div class="machine-attribute machine-operator">
                        <img src="../Style/Images/user-solid.svg"><span></span>
                    </div>
                </button>
                <button class="machine-container" id="machine6">
                    <h3 class="machine-name"></h3>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-attribute machine-status">
                        <img src="../Style/Images/idle.svg"><span></span>
                    </div>
                    <div class="machine-attribute machine-operator">
                        <img src="../Style/Images/user-solid.svg"><span></span>
                    </div>
                </button>
                <button class="machine-container" id="machine7">
                    <h3 class="machine-name"></h3>
                    <img class="machine-image" src="../Style/Images/Machines/placeholder.png">
                    <div class="machine-attribute machine-status">
                        <img src="../Style/Images/idle.svg"><span></span>
                    </div>
                    <div class="machine-attribute machine-operator">
                        <img src="../Style/Images/user-solid.svg"><span></span>
                    </div>
                </button>
            </div>
            <div class="navigation-pane">
                <button class="navbutton" id="prev-page">◀</button>
                <div id="current-page">1</div>
                <button class="navbutton" id="next-page">▶</button>
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
        let userId = <?php echo ($_SESSION["userid"]); ?>;
        let machines = <?php echo json_encode($machines); ?>;
    </script>
    <script src="script.js" defer></script></body>
</body>
</html>