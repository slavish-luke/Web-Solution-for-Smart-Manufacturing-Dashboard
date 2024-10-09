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
                        $sql = "SELECT name FROM machine WHERE name LIKE ?";
                        $statement = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($statement, $sql); 
                        mysqli_stmt_bind_param($statement, 's', $name); 
                        if (mysqli_stmt_execute($statement)){
                            $result = mysqli_stmt_get_result($statement);
                            if (mysqli_num_rows($result) >= 1){
                                echo("<ul>");
                                while ($row = mysqli_fetch_assoc($result)){
                                    echo("<li><a href='Edit-Machine.php?machine=$row[name]&search-box='>$row[name]</a></li>");
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

                <!--Singluar container for a pie chart -->
                <div class="charts">
                    <h2>Average Production Count</h2>
                    <svg class="pie-chart" viewBox="0 0 36 36">
                        <circle class="background" r="16" cx="18" cy="18"></circle>
                        <circle id="production-count" class="foreground" r="16" cx="18" cy="18" stroke-dasharray="0 100" transform="rotate(-90 18 18)"></circle>
                    </svg>

                    <!--Contianer for the percentages -->
                    <div class="display-stats">
                        <h3 id="production-count"></h3>
                    </div>
                </div>

                <!--Singluar container for a pie chart -->
                <div class="charts">
                    <h2>Operational <br> Status</h2>
                    <svg class="pie-chart" viewBox="0 0 36 36">
                        <circle class="background" r="16" cx="18" cy="18"></circle>
                        <circle id="operational-status" class="foreground" r="16" cx="18" cy="18" stroke-dasharray="0 100" transform="rotate(-90 18 18)"></circle>
                    </svg>

                    <!--Contianer for the percentages -->         
                    <div class="display-stats">
                        <h3 id="operational-status"></h3>
                    </div>
                </div>

                <!--Singluar container for a pie chart -->
                <div class="charts">
                    <h2>Average Power Consumption</h2>
                    <svg class="pie-chart" viewBox="0 0 36 36">
                        <circle class="background" r="16" cx="18" cy="18"></circle>
                        <circle id="average-power-consumption" class="foreground" r="16" cx="18" cy="18" stroke-dasharray="0 100" transform="rotate(-90 18 18)"></circle>
                    </svg>
                    
                    <!--Contianer for the percentages -->
                    <div class="display-stats">
                        <h3 id="power-consumption"></h3>
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

    <script type="text/javascript">let rawFactoryData = <?php echo json_encode($factory_data); ?>;</script>
    <script src="../Factory-Managers/scripts.js" defer></script>
</body>
</html> 