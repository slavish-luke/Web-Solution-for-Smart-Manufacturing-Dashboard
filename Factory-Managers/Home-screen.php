<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <link rel="stylesheet" href="../Style/Main.css">
    <link rel="stylesheet" href="../Style/Skeleton.css">
    <link rel="stylesheet" href="../Style/Factory-Managers.css">
    <title>Dashboard</title>
</head>

<header>
    <!--Home Button-->
    <div class="home-button">
        <a href="../Factory-Managers/home-Screen.html">
            <img src="../Style/Images/home-button.svg" alt="home button image" id="homeicon">
        </a>
    </div>

    <!--Settings cog-->
    <div class="settings-button">
        <img src="../Style/Images/settings-cog.svg" alt="Settings cog" id="settingsicon">
    </div>

    <!--Settings options-->
    <div class="settings-menu">
        <ul>
            <li><a href="a">Machines</a></li>
            <li><a href="a">Users</a></li>
            <li><a href="a">Statistics</a></li>
            <li><a href="../Main/settings.html">Options</a></li>
            <li><a href="../Main/login.html">Log Out</a></li>
        </ul>
    </div>
</header>

<body>
    <section id="content">
        <aside>
            <!--Search Bar-->
            <div class="search-bar">
                <p id="search-bar-name">Machines</p>
                <input type="text" id="search-box" placeholder="Search Machines">
            </div>

            <!--List of machines-->
            <div id="machine-list"></div>
        </aside>
        <!--Statistics side-->
        <div class="stats"></div>

        <!--Users-->
        <button type="button" class="collapse"></button>
        <div class="user-list" id="user-auditors">

        <button type="button" class="collapse"></button>
        <div class="user-list" id="user-Auditors">

        <button type="button" class="collapse"></button>
        <div class="user-list" id="user-Auditors">

        <button type="button" class="collapse"></button>
        <div class="user-list" id="user-Auditors">
    </section>

    <!--PHP code for machine list-->
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
    <script src="Machine-List.js" defer></script>
    <script src="Collapse-List.js" defer></script>

</body>

</html> 