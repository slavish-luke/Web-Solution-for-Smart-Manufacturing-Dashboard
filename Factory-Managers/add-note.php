<?php
session_start();
require_once "../inc/dbconn.inc.php"; 
$sql = "UPDATE machine SET note = ? WHERE name=?" ;
$statement = mysqli_stmt_init($conn);
$machine = htmlspecialchars($_POST['machine']);
mysqli_stmt_prepare($statement, $sql); 
mysqli_stmt_bind_param($statement, 'ss', htmlspecialchars($_POST["notes"]), $_POST['machine']); 
if (mysqli_stmt_execute($statement)){
    header("location: Edit-Machine.php?machine=$machine&search-box=");
}
else{
    mysqli_error($conn);
}
mysqli_close($conn);
?>
