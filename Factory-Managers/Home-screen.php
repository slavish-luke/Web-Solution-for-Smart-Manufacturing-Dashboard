<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <link rel="stylesheet" href="../Style/Skeleton.css">
    <link rel="stylesheet" href="../Style/Factory-Managers.css">
    <script type="text/javascript">
        document.getElementById("search-box").value = "";
    </script>
    <title>Dashboard</title>
</head>

<header>
    <!--Home Button-->
    <div>
        <a href="../Factory-Managers/Home-Screen.php?search-box=">
            <img src="../Style/Images/home-button.svg" alt="home button image" id="Home-icon">
        </a>
    </div>

    <!--Welcome Message-->
    <div id="Welcome-message">
        <a href="../logout.php">
            <p>Welcome <?php session_start(); echo("$_SESSION[username]"); ?>
            </p>
        </a>
    </div>

    <!--Settings Button-->
    <div>
        <details id="settings-dropdown">
            <summary>
            <img src="../Style/Images/settings-cog.svg" alt="Settings cog" id="Settings-icon">
            </summary>
            <a href="../logout.php">Logout</a>
        </details>
    </div>
    
</header>

<body>
    <div id="Main-content">
        <aside>
            <!--Search Bar-->
            <div class="search-bar">
                <p id="search-bar-name">Machines</p>
                <form action="" method="GET">
                <input type="text" id="search-box" placeholder="Search Machines" name="search-box">
                </form>
            </div>

            <!--List of machines-->
            <div id="machine-list">
                <form action="Edit-Machine.php" method="get" id="to-machine">
                <?php
                    require_once "../inc/dbconn.inc.php";
                        $name = "%" . htmlspecialchars($_GET["search-box"]) . "%";
                        $sql = "SELECT * FROM machine WHERE name LIKE ?";
                        $statement = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($statement, $sql); 
                        mysqli_stmt_bind_param($statement, 's', $name); 
                        if (mysqli_stmt_execute($statement)){
                            $result = mysqli_stmt_get_result($statement);
                            if (mysqli_num_rows($result) >= 1){
                                echo("<ul>");
                                while ($row = mysqli_fetch_assoc($result)){
                                    echo("<li><a href='Edit-Machine.php?machine=$row[id]&search-box='>$row[name]</a></li>");
                                }
                                echo("</ul>");
                                mysqli_free_result($result);
                            }
                        }
                    ?>
                </form>
            </div>
        </aside>

        <!--Statistics side-->
        <div id="stats">
            <h1>Statistics</h1>

            <!--Container for all the pie charts-->
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
                    <h2 class="h2-bottom">Average speed</h2>

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

        <!--Users-->
        <div id="users">
            <h1>User Management System</h1>

            <details class="user-list" id="user-administrators">
                <summary>Administrators</summary>
                <?php
                require_once "../inc/dbconn.inc.php";
                $sql = "SELECT username FROM account WHERE role_id = 1";
                $statement = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($statement, $sql); 
                if (mysqli_stmt_execute($statement)){
                    $result = mysqli_stmt_get_result($statement);
                    if (mysqli_num_rows($result) >= 1){
                        echo("<ul>");
                        while ($row = mysqli_fetch_assoc($result)){
                            echo("<li>$row[username]</a></li>");
                        }
                        echo("</ul>");
                        mysqli_free_result($result);
                    }
                }
                
                ?>
            </details>

            <details class="user-list" id="user-managers">
                <summary>Managers</summary>
                <?php
                require_once "../inc/dbconn.inc.php";
                $sql = "SELECT username FROM account WHERE role_id = 3";
                $statement = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($statement, $sql); 
                if (mysqli_stmt_execute($statement)){
                    $result = mysqli_stmt_get_result($statement);
                    if (mysqli_num_rows($result) >= 1){
                        echo("<ul>");
                        while ($row = mysqli_fetch_assoc($result)){
                            echo("<li>$row[username]</a></li>");
                        }
                        echo("</ul>");
                        mysqli_free_result($result);
                    }
                }
                
                ?>
            </details>

            <details class="user-list" id="user-operators">
                <summary>Operators</summary>
                <?php
                require_once "../inc/dbconn.inc.php";
                $sql = "SELECT username FROM account WHERE role_id = 4";
                $statement = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($statement, $sql); 
                if (mysqli_stmt_execute($statement)){
                    $result = mysqli_stmt_get_result($statement);
                    if (mysqli_num_rows($result) >= 1){
                        echo("<ul>");
                        while ($row = mysqli_fetch_assoc($result)){
                            echo("<li>$row[username]</a></li>");
                        }
                        echo("</ul>");
                        mysqli_free_result($result);
                    }
                }
                ?>
            </details>
        </div>

        <!--Inbox to read messages-->
        <div id="inbox">
            <h1>Inbox</h1>
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
    <script src="../Factory-Managers/scripts.js" defer></script>
</body>
</html> 