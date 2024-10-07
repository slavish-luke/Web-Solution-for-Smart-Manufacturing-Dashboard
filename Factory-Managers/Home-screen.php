<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <link rel="stylesheet" href="../Style/Skeleton.css">
    <link rel="stylesheet" href="../Style/Factory-Managers.css">
    <title>Dashboard</title>
</head>

<header>
    <!--Home Button-->
    <div>
        <a href="../Factory-Managers/Home-Screen.php">
            <img src="../Style/Images/home-button.svg" alt="home button image" id="Home-icon">
        </a>
    </div>

    <!--Welcome Message-->
    <div id="Welcome-message">
        <a href="../logout.php">
            <p>Welcome John Doe</p>
        </a>
    </div>

    <!--Settings Button-->
    <div>
        <details id="settings-dropdown">
            <summary>
            <img src="../Style/Images/settings-cog.svg" alt="Settings cog" id="Settings-icon">
            </summary>
            <a href="../Factory-Managers/Home-Screen.php">Options</a>
            <br>
            <a href="../Factory-Managers/Edit-Machine.php">Machines</a>
            <br>
            <a href="../Factory-Managers/Home-Screen.php">Statistics</a>
            <br>
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
            <?php
                require_once "../inc/dbconn.inc.php";
                $sql = "SELECT name FROM machine WHERE name LIKE ?";
                $name = htmlspecialchars($_GET["search-box"]) . "%";
                $statement = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($statement, $sql); 
                mysqli_stmt_bind_param($statement, 's', $name); 
                if (mysqli_stmt_execute($statement)){
                    $result = mysqli_stmt_get_result($statement);
                    if (mysqli_num_rows($result) >= 1){
                        echo("<ul>");
                        while ($row = mysqli_fetch_assoc($result)){
                            echo("<li>$row[name]</a></li>");
                        }
                        echo("</ul>");
                        mysqli_free_result($result);
                    }
                }
                mysqli_close($conn);
                ?>
                <div id="machines"></div>
            </div>
        </aside>

        <!--Statistics side-->
        <div id="stats">
            <h1>Statistics</h1>

        </div>

        <!--Users-->
        <div id="users">
            <h1>User Management System</h1>

            <details class="user-list" id="user-administrators">
                <summary>Administrators</summary>
                Test
            </details>

            <details class="user-list" id="user-managers">
                <summary>Managers</summary>
                Test
            </details>

            <details class="user-list" id="user-operators">
                <summary>Operators</summary>
                Test
            </details>
        </div>

        <div id="inbox">
            <h1>Inbox</h1>
        </div>
    </div>

    <script type="text/javascript">let rawFactoryData =<?php echo json_encode($factory_data); ?>;</script>
    <script src="script.js" defer></script>
</body>
</html> 