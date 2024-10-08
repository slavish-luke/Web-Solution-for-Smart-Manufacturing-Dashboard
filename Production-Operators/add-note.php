<?php


    require_once "../inc/dbconn.inc.php";
    
    
    $users = $_POST['users'];
    $machines = isset($_POST['machines']) ? $_POST['machines'] : []; // Check if machines is set
    $subject = htmlspecialchars($_POST['note-subject']);
    $note = htmlspecialchars($_POST['note-content']);

    $sqlNoMachine = "INSERT INTO notes (user_id, notes_subject, notes_content) VALUES (?, ?, ?)";
    $sqlMachine = "INSERT INTO notes (machine_id, user_id, notes_subject, notes_content) VALUES (?, ?, ?, ?)";

    if(empty($note)){
        header("location: notes.php?error=empty_note");
        exit();
    }

    // $statement = mysqli_stmt_init($conn);

    // mysqli_stmt_prepare($statement, $sql); 
    // mysqli_stmt_bind_param($statement, 's', htmlspecialchars($_POST["machine-note"])); 
    // The 's' in mysqli_stmt_bind_param indicates a string parameter

    // if(mysqli_stmt_execute($statement)){
            
        echo "<h1>MACHINES</h1><p>";
        print_r($machines);
        echo "</p>";
        
        echo "<h1>USERS</h1><p>";
        print_r($users);
        echo "</p>";

        echo "<h1>MACHINE NOTE</h1><p>";
        echo $note;
        echo "</p>";

        echo "<h1>All users</h1>";
        
        if ($stmtMachine = mysqli_prepare($conn, $sqlMachine)) {
            foreach ($users as $user) {
                if (!$machines) {
                    if ($stmtNoMachine = mysqli_prepare($conn, $sqlNoMachine)) {
                        mysqli_stmt_bind_param($stmtNoMachine, 'sss', $user, $subject, $note);
                        if (!mysqli_stmt_execute($stmtNoMachine)) {
                            echo "Error: " . mysqli_error($conn);
                        }
                    }
                } else {
                    foreach ($machines as $machine) {
                        mysqli_stmt_bind_param($stmtMachine, 'ssss', $machine, $user, $subject, $note);
                        if (!mysqli_stmt_execute($stmtMachine)) {
                            echo "Error: " . mysqli_error($conn);
                        }
                    }
                }
            }
            header("location: notes.php");
        }
    
    // }else{
    //     echo mysqli_error($conn);
    // }
mysqli_close($conn);


?>