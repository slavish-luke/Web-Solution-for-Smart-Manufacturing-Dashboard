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
        <img src="../Style/Images/settings-cog.svg" alt="Settings cog" id="Settings-icon">
    </div>
</header>

<body>
    <div id="Main-content">
        <aside>
            <!--Search Bar-->
            <div class="search-bar">
                <p id="search-bar-name">Machines</p>
                <input type="text" id="search-box" placeholder="Search Machines">
            </div>

            <!--List of machines-->
            <div id="machine-list">
                <div id="machines"></div>
            </div>
        </aside>

        <!--Statistics side-->
        <div class="stats"></div>

        <!--Users-->
        <div id="users">
            <h1>User Management System</h1>

            <details class="user-list" id="user-administrators">
                <summary></summary>
            </details>

            <details class="user-list" id="user-managers">
                <summary></summary>
            </details>

            <details class="user-list" id="user-operators">
                <summary></summary>
            </details>
        </div>
    </div>

    <script type="text/javascript">let rawFactoryData =<?php echo json_encode($factory_data); ?>;</script>
    <script src="script.js" defer></script>
</body>
</html> 