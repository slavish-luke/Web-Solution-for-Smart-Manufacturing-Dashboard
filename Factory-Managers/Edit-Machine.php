<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <link rel="stylesheet" href="../Style/Skeleton.css">
    <link rel="stylesheet" href="../Style/Factory-Managers.css">
    <script src="scripts.js" defer></script>
    <title>Edit Machines</title>
</head>

<header>
    <!--Home Button-->
    <div id="home-icon-div">
        <a href="../Factory-Managers/Home-Screen.php?search-box=">
            <img src="../Style/Images/home-button.svg" alt="home button image" id="Home-icon">
        </a>
    </div>

    <div id="machine-name">
        <p id="machine-name">
            <?php 
                require_once "../inc/dbconn.inc.php";
                $sql = "SELECT name FROM machine WHERE id = ?";
                $note = htmlspecialchars($_GET['machine']);
                $statement = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($statement, $sql);
                mysqli_stmt_bind_param($statement, 's', $note); 
                if (mysqli_stmt_execute($statement)){
                    $result = mysqli_stmt_get_result($statement);
                    if (mysqli_num_rows($result) >= 1){
                        while ($row = mysqli_fetch_assoc($result)){
                            echo("$row[name]");
                        }
                        mysqli_free_result($result);
                    }
                }
            ?>
        </p>
    </div>

    <!--Settings cog-->
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
            <div>
                <p id="search-bar-name-edit-machines">Edit Machines</p>
                <form action="" method="GET">
                    <input type="text" id="search-box" placeholder="Search Machines" name="search-box">
                    <input type="hidden" name="machine" value="<?php echo htmlspecialchars($_GET['machine']);?>">
                </form>
            </div>

            <!--List of machines-->
            <div id="machine-list"></div>
                <form action="Edit-Machine.php" method="get" id="to-machine">
                    <?php
                        require_once "../inc/dbconn.inc.php";
                        $sql = "SELECT * FROM machine WHERE name LIKE ?";
                        $name = "%" . htmlspecialchars($_GET["search-box"]) . "%";
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

                <div id="add-remove-button">
                    <!--Buttons to add-->
                    <button type="button" id="add-button">Add</button>

                    <!--Buttons to remove-->
                    <button type="button" id="remove-button">Remove</button>
                </div>
            </div>

            <!--Add machine modal-->
            <div id="add-machine-modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form class="add-remove-machine-modal" action="add-machine.php?machine=<?php echo htmlspecialchars($_GET['machine']);?>&search-box=" method="post">
                        <input type="hidden" name="machine" value="<?php echo htmlspecialchars($_GET['machine']);?>">
                        <h1>Machine Name</h1>
                        <input type="text" id="new-machine-name" name="machine-name" required>
                        <h1>Machine Image</h1>
                        <label for="image-input">Copy and Paste Image url Below</label>
                        <input type="text" id="image-input" name="image-input">
                        <h1>Assign Operator</h1>
                        <select name="creation-operator" id="modal-set-operator">
                            <?php
                                require_once "../inc/dbconn.inc.php";
                                $sql = "SELECT * FROM account where role_id = 4";
                                $statement = mysqli_stmt_init($conn);
                                mysqli_stmt_prepare($statement, $sql); 
                                if (mysqli_stmt_execute($statement)){
                                    $result = mysqli_stmt_get_result($statement);
                                    if (mysqli_num_rows($result) >= 1){
                                        while ($row = mysqli_fetch_assoc($result)){
                                            echo("<option value=$row[id]>$row[name]</option>");
                                        }
                                        mysqli_free_result($result);
                                    }
                                }
                            ?>
                        <input type='submit' id='create-machine' name='create-machine' value='Create Machine'>
                    </form>
                </div>
            </div>

            <!--Remove machine modal-->
            <div id="remove-machine-modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form class="add-remove-machine-modal" action="remove-machine.php?machine=<?php echo htmlspecialchars($_GET['machine']);?>&search-box=" method="post">
                        <h1>Select Machine</h1>    
                        <input type="hidden" name="machine" value="<?php echo htmlspecialchars($_GET['machine']);?>">
                        <select name="removal" id="machine-dropdown">
                            <?php
                                require_once "../inc/dbconn.inc.php";
                                $sql = "SELECT * FROM machine";
                                $statement = mysqli_stmt_init($conn);
                                mysqli_stmt_prepare($statement, $sql); 
                                if (mysqli_stmt_execute($statement)){
                                    $result = mysqli_stmt_get_result($statement);
                                    if (mysqli_num_rows($result) >= 1){
                                        while ($row = mysqli_fetch_assoc($result)){
                                            echo("<option value=$row[id]>$row[name]</option>");
                                        }
                                        mysqli_free_result($result);
                                    }
                                }
                            ?>
                        </select>
                        <input type='submit' id='delete-machine' name='delete-machine' value='Remove Machine'> 
                    </form>
                </div>
            </div>
        </aside>

        <!--Container for the options of each machine-->
        <div id="edit-machines">
            <form action="add-note.php?machine=<?php echo htmlspecialchars($_GET['machine']);?>&search-box=" method="post">
                <input type="hidden" name="machine" value="<?php echo htmlspecialchars($_GET['machine']);?>">
                <input type="hidden" name="search-box" value="<?php echo htmlspecialchars($_GET['search-box']);?>">
                
                <!-- Div for editing the machine name -->
                <div id="Machine-name">
                    <h1>Machine Name</h1>
                    <input type="text" name="machine-name" value="<?php
                    require_once "../inc/dbconn.inc.php";
                    $sql = "SELECT * FROM machine WHERE id = ?";
                    $note = htmlspecialchars($_GET['machine']);
                    $statement = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($statement, $sql);
                    mysqli_stmt_bind_param($statement, 's', $note); 
                    if (mysqli_stmt_execute($statement)){
                        $result = mysqli_stmt_get_result($statement);
                        if (mysqli_num_rows($result) >= 1){
                            while ($row = mysqli_fetch_assoc($result)){
                                echo("$row[name]");
                            }
                            mysqli_free_result($result);
                        }
                    }
                    
                    ?>">
                </div>

                <!--Div for keeping notes about the machine-->
                <div id="Machine-notes">
                    <h1>Machine Notes</h1>
                    <textarea id="notes-textarea" name="notes"><?php 
                            require_once "../inc/dbconn.inc.php";
                            $sql = "SELECT note FROM machine WHERE id = ?";
                            $note = htmlspecialchars($_GET['machine']);
                            $statement = mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($statement, $sql);
                            mysqli_stmt_bind_param($statement, 's', $note); 
                            if (mysqli_stmt_execute($statement)){
                                $result = mysqli_stmt_get_result($statement);
                                if (mysqli_num_rows($result) >= 1){
                                    while ($row = mysqli_fetch_assoc($result)){
                                        echo("$row[note]");
                                    }
                                    mysqli_free_result($result);
                                }
                            }
                        ?></textarea>
                </div>

                <!--Div for keeping the status of the machine-->
                <div id="Machine-status">
                    <h1>Machine Status</h1>
                    <div id="status-button-container">
                        <!-- <button type="button" class="status-button-on">On</button>
                        <button type="button" class="status-button-off">Off</button> -->
                        <?php
                            require_once "../inc/dbconn.inc.php";
                            $sql = "SELECT * FROM machine WHERE id = ?";
                            $note = htmlspecialchars($_GET['machine']);
                            $statement = mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($statement, $sql);
                            mysqli_stmt_bind_param($statement, 's', $note); 
                            if (mysqli_stmt_execute($statement)){
                                $result = mysqli_stmt_get_result($statement);
                                if (mysqli_num_rows($result) >= 1){
                                    while ($row = mysqli_fetch_assoc($result)){
                                        if ($row['operational_status'] == "active"){
                                            echo(
                                                "<input type='radio' id='status-active' name='status-button' class='status-button' value='active' checked>
                                                <label for='status-active' class='status-button'>Active</label>
                                                <input type='radio' id='status-idle' name='status-button' class='status-button' value='idle'>
                                                <label for='status-idle' class='status-button'>Idle</label>
                                                <input type='radio' id='status-maintenance' name='status-button' class='status-button' value='maintenance'>
                                                <label for='status-maintenance' id='status-maintenance-button' class='status-button'>Maintenance</label>");
                                        }
                                        else if ($row['operational_status'] == "idle"){
                                            echo(
                                                "<input type='radio' id='status-active' name='status-button' class='status-button' value='active'>
                                                <label for='status-on' class='status-button'>Active</label>
                                                <input type='radio' id='status-idle' name='status-button' class='status-button' value='idle' checked>
                                                <label for='status-off' class='status-button'>Idle</label>
                                                <input type='radio' id='status-maintenance' name='status-button' class='status-button' value='maintenance'>
                                                <label for='status-off' id='status-maintenance-button' class='status-button'>Maintenance</label>");
                                        }
                                        else if ($row['operational_status'] == "maintenance"){
                                            echo(
                                                "<input type='radio' id='status-active' name='status-button' class='status-button' value='active'>
                                                <label for='status-on' class='status-button'>Active</label>
                                                <input type='radio' id='status-idle' name='status-button' class='status-button' value='idle'>
                                                <label for='status-off' class='status-button'>Idle</label>
                                                <input type='radio' id='status-maintenance' name='status-button' class='status-button' value='maintenance' checked>
                                                <label for='status-off' id='status-maintenance-button' class='status-button'>Maintenance</label>");
                                        }
                                    }
                                    mysqli_free_result($result);
                                }
                            }
                        ?>
                    </div>
                </div>

                <!--Div for keeping the machine image-->
                <div id="Machine-image">
                    <h1>Machine Image</h1>
                    <label for="image-input">Copy and Paste Image url Below</label>
                    <input type="text" id="image-input" name="image-input">
                    <img id="imagePreview" src="<?php require_once "../inc/dbconn.inc.php";
                    $sql = "SELECT img_address FROM machine WHERE id = ?";
                    $note = htmlspecialchars($_GET['machine']);
                    $statement = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($statement, $sql);
                    mysqli_stmt_bind_param($statement, 's', $note); 
                    if (mysqli_stmt_execute($statement)){
                        $result = mysqli_stmt_get_result($statement);
                        if (mysqli_num_rows($result) >= 1){
                            while ($row = mysqli_fetch_assoc($result)){
                                echo("$row[img_address]");
                            }
                            mysqli_free_result($result);
                        }
                    }?>" alt="Image Preview">
                </div>

                <!--Div for confirming to keeping the changes or not-->
                <div id="Machine-confirm">
                    <h1>Confirm</h1>
                    <div id="confirm-button-container">
                        <input type="submit" class="confirm-button" value="Save">
                        <button class="confirm-button"><a href="Home-screen.php?search-box=">Exit</a></button>
                        <button type="button" class="confirm-button"><a href="Edit-Machine.php?machine=<?php echo(htmlspecialchars($_GET['machine']));?>&search-box=">Clear</a></button>
                    </div>
                </div>

            <!--Div for assigning the operator to the machine-->
            <div id="Assign-operator">
                <h1>Assign Operator</h1>
                <div id="show-operators">
                    <select name="machine-operator" id="machine-operator">
                        <?php
                        require_once "../inc/dbconn.inc.php";
                        $sql = "SELECT * FROM machine where id = ?";
                        $statement = mysqli_stmt_init($conn);
                        $note = htmlspecialchars($_GET['machine']);
                        mysqli_stmt_prepare($statement, $sql); 
                        mysqli_stmt_bind_param($statement, 's', $note); 
                        if (mysqli_stmt_execute($statement)){
                            $result = mysqli_stmt_get_result($statement);
                            if (mysqli_num_rows($result) >= 1){
                                while ($row = mysqli_fetch_assoc($result)){
                                    $op = $row['operator_id'];
                                    
                                }
                                mysqli_free_result($result);
                            }
                        }
                        $sql = "SELECT * FROM account where role_id = 4";
                        $statement = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($statement, $sql); 
                        if (mysqli_stmt_execute($statement)){
                            $result = mysqli_stmt_get_result($statement);
                            if (mysqli_num_rows($result) >= 1){
                                while ($row = mysqli_fetch_assoc($result)){
                                    if ($row['id'] == $op){
                                        echo("<option value=$row[id] selected='selected'>$row[name]</option>");
                                    }
                                    else{
                                        echo("<option value=$row[id]>$row[name]</option>");
                                    }
                                    
                                }
                                mysqli_free_result($result);
                            }
                        }?>
                    </select>
                </div>
                
                </form>

                <!-- Dive for adding a job to the machine-->
                <div id="add-job-div">
                    <h1>Assign Job</h1>
                    <form id="add-job" action="add-task.php?machine=<?php echo htmlspecialchars($_GET['machine']);?>&search-box=" method="post">
                        <input type="hidden" name="machine" value="<?php echo htmlspecialchars($_GET['machine']);?>">
                        <select name="assigned-operator" id="assigned-operator">
                            <?php
                            require_once "../inc/dbconn.inc.php";
                            $sql = "SELECT * FROM account where role_id = 4";
                            $statement = mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($statement, $sql); 
                            if (mysqli_stmt_execute($statement)){
                                $result = mysqli_stmt_get_result($statement);
                                if (mysqli_num_rows($result) >= 1){
                                    while ($row = mysqli_fetch_assoc($result)){
                                        echo("<option value=$row[id]>$row[name]</option>");
                                    }
                                    mysqli_free_result($result);
                                }
                            }?>
                        </select>
                        <input id="job-submit" type="submit" value="Add Task">
                        <textarea id="job-desc-textarea" name="job-desc"></textarea>
                    </form>

                    <!-- The Edit Task Modal -->
                    <button type="button" id="edit-task-button">Edit</button>
                    
                    <div id="edit-task-modal" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <form class="add-remove-machine-modal" action="edit-task.php?machine=<?php echo htmlspecialchars($_GET['machine']);?>&search-box=" method="post">
                            <h1>Select Task</h1>    
                            <input type="hidden" name="machine" value="<?php echo htmlspecialchars($_GET['machine']);?>">
                                <select name="edited" id="task-dropdown">
                                <?php
                                require_once "../inc/dbconn.inc.php";
                                $sql = "SELECT * FROM task where machine_id = ?";
                                $statement = mysqli_stmt_init($conn);
                                $note = htmlspecialchars($_GET['machine']);
                                mysqli_stmt_prepare($statement, $sql); 
                                mysqli_stmt_bind_param($statement, 's', $note); 
                                if (mysqli_stmt_execute($statement)){
                                    $result = mysqli_stmt_get_result($statement);
                                    if (mysqli_num_rows($result) >= 1){
                                        while ($row = mysqli_fetch_assoc($result)){
                                            echo("<option value=$row[id]>$row[job_desc]</option>");
                                        }
                                        mysqli_free_result($result);
                                    }
                                }
                            ?>
                                </select>
                                <textarea id='new-task' name='new-task'></textarea>
                                <input type='submit' id='delete-machine' name='delete-machine' value='Edit Task'>
                                
                            </form>
                        </div>
                    </div>

                    <!--Show which tasks this machine has-->
                    <div id="job-list">
                        <?php
                        require_once "../inc/dbconn.inc.php";
                        $sql = "SELECT t.*, a.name AS user_name FROM task t JOIN account a ON t.operator_id = a.id WHERE machine_id = ? ORDER BY id DESC;";
                        $statement = mysqli_stmt_init($conn);
                        $note = htmlspecialchars($_GET['machine']);
                        mysqli_stmt_prepare($statement, $sql);
                        mysqli_stmt_bind_param($statement, 's', $note);  
                        if (mysqli_stmt_execute($statement)){
                            $result = mysqli_stmt_get_result($statement);
                            if (mysqli_num_rows($result) >= 1){
                                while ($row = mysqli_fetch_assoc($result)){
                                    echo("
                                        <details>
                                            <summary>Assgined Operator: $row[user_name] <a href='delete-task.php?machine=$note&deletion=$row[id]&search-box='>&times;</a></summary>
                                            $row[job_desc]
                                        </details>
                                    ");
                                }
                                mysqli_free_result($result);
                            }
                        }?>
                    </div>

                    

                </div>
            </div>
        </div>
    </div>

    <!--PHP code for machine list-->

</body>

</html> 