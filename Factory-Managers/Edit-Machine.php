<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <link rel="stylesheet" href="../Style/Skeleton.css">
    <link rel="stylesheet" href="../Style/Factory-Managers.css">
    <title>Edit Machines</title>
</head>

<header>
    <!--Home Button-->
    <div>
        <a href="../Factory-Managers/Home-Screen.php">
            <img src="../Style/Images/home-button.svg" alt="home button image" id="Home-icon">
        </a>
    </div>

    <div id="machine-name">
        <p>Machine Name</p>
    </div>

    <!--Settings cog-->
    <div>
        <img src="../Style/Images/settings-cog.svg" alt="Settings cog" id="Settings-icon">
    </div>
</header>

<body>
    <div id="Main-content">
        <aside>
            <!--Search Bar-->
            <div>
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
                <h1>Machine Notes</h1>
                <textarea id="notes-textarea"></textarea>
            </div>

            <div id="Machine-status">
                <h1>Machine Status</h1>
                <button type="button" class="status-button">On</button>
                <button type="button" class="status-button">Off</button>
            </div>

            <div id="Machine-image">
                <h1>Machine Image</h1>
                <input type="file" id="image-input"><input>
            </div>

            <div id="Machine-confirm">
                <h1>Confirm</h1>
                <button type="button" class="confirm-button">Save</button>
                <button type="button" class="confirm-button">Exit</button>
                <button type="button" class="confirm-button">Clear</button>
            </div>
        </div>
    </div>

    <!--PHP code for machine list-->
    <?php
        require_once "../inc/dbconn.inc.php";

        $sql = "SELECT id, machine_name, timestamp, temperature, pressure, vibration, power_consumption, operational_status, error_code, production_count, maintenance_log, speed FROM factory_log;";

        if($result = mysqli_query($conn, $sql)){

            if(mysqli_num_rows($result) >= 1){
                
                while ($row = mysqli_fetch_assoc($result)) {

                    $factory_data[] = $row;
                }
                mysqli_free_result($result);
            }
        }
        mysqli_close($conn); 
    ?>

    <script type="text/javascript">let rawFactoryData =<?php echo json_encode($factory_data); ?>;</script>
    <script src="Machine-List.js" defer></script>
     
</body>

</html> 