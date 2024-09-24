<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <link rel="stylesheet" href="../Style/Main.css">
    <link rel="stylesheet" href="../Style/Skeleton.css">
    <link rel="stylesheet" href="../Style/Factory-Managers.css">
    <title>Edit Machines</title>
</head>

<header>
    <!--Home Button-->
    <div class="home-button">
        <a href="../Factory-Managers/home-Screen.html">
            <img src="../Style/Images/home-button.svg" alt="home button image" id="homeicon">
        </a>
    </div>

    <div id="machine-name">
        <p>Machine Name</p>
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
    <div id="main-content">
        <aside>
            <!--Search Bar-->
            <div class="search-bar">
                <p id="search-bar-name">Edit Machines</p>
                <input type="text" id="search-box" placeholder="Search Machines">
            </div>

            <!--List of machines-->
            <div id="machine-list"></div>

            <div id="add-remove-button">
                <!--Buttons to add-->
                <button type="button" id="add-button">Add</button>

                <!--Buttons to remove-->
                <button type="button" id="remove-button">Remove</button>
            </div>
        </aside>

        <div id="edit-machines">
            <div id="Machine-notes">
                <p>Machine Notes</p>
                <textarea id="notes-textarea"></textarea>
            </div>

            <div id="Machine-status">
                <p>Machine Status</p>
                <button type="button" class="status-button">On</button>
                <button type="button" class="status-button">Off</button>
            </div>

            <div id="Machine-image">
                <p>Machine Image</p>
                <input type="file" id="image-input"><input>
            </div>

            <div id="Machine-confirm">
                <p>Confirm</p>
                <button type="button" class="confirm-button">Save</button>
                <button type="button" class="confirm-button">Exit</button>
                <button type="button" class="confirm-button">Clear</button>
            </div>
        </div>
    </div>

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
     
</body>

</html> 