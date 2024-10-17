<?php
if (isset($_POST["id"]) && isset($_POST["status"])) {
    require_once "../inc/dbconn.inc.php";

    $sql = "UPDATE machine SET operational_status = ? WHERE id = ?";
    $statement = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($statement, $sql);
    mysqli_stmt_bind_param($statement, 'ss', htmlspecialchars($_POST["status"]), htmlspecialchars($_POST["id"]));

    if (mysqli_stmt_execute($statement)) {
        header("location: machines.php");
    } else {
        echo mysqli_error($conn);
    }
    
    mysqli_close($conn);
} 
?>