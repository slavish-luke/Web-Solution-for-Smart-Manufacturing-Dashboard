<?php

    session_start();
    require_once "../inc/dbconn.inc.php";
    
    
    $users = $_POST['users'];
    $machines = isset($_POST['machines']) ? $_POST['machines'] : []; // Check if machines is set
    $subject = htmlspecialchars($_POST['note-subject']);
    $note = htmlspecialchars($_POST['note-content']);
    
    $_SESSION['subject'] = $subject;
    $_SESSION['note'] = $note;
    $userFrom = $_SESSION['userid'];

    $sqlNoMachine = "INSERT INTO note (user_id_to, user_id_from, subject, content) VALUES (?, ?, ?, ?)";
    $sqlMachine = "INSERT INTO note (machine_id, user_id_to, user_id_from, subject, content) VALUES (?, ?, ?, ?, ?)";

    if(empty($note) && empty($users)){
        header("location: notes.php?error=blank_form");
        exit();
    
    }else if(empty($note)){
        header("location: notes.php?error=empty_note");
        exit();
    
    }else if(empty($users)){
        header("location: notes.php?error=no_users");
        exit();
    }

    
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
                    mysqli_stmt_bind_param($stmtNoMachine, 'ssss', $user, $userFrom, $subject, $note);
                    if (!mysqli_stmt_execute($stmtNoMachine)) {
                        echo "Error: " . mysqli_error($conn);
                    }
                }
            } else {
                foreach ($machines as $machine) {
                    mysqli_stmt_bind_param($stmtMachine, 'sssss', $machine, $user, $userFrom, $subject, $note);
                    if (!mysqli_stmt_execute($stmtMachine)) {
                        echo "Error: " . mysqli_error($conn);
                    }
                }
            }
        }
        header("location: notes.php");
        $_SESSION['subject'] = "";
        $_SESSION['note'] = "";
    }


mysqli_close($conn);


?>