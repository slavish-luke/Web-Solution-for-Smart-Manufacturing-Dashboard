<?php
if (isset($_POST["id"])) {
    require_once "../inc/dbconn.inc.php";
    
    $sql = "UPDATE task SET complete = true WHERE id = ?";
    $statement = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($statement, $sql);
    mysqli_stmt_bind_param($statement, 's', htmlspecialchars($_POST["id"]));

    if (mysqli_stmt_execute($statement)) {
        header("location: jobs.php");
    } else {
        echo mysqli_error($conn);
    }
    
    mysqli_close($conn);
} 
?>