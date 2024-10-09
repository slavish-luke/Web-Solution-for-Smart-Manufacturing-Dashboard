<?php
session_start();
require_once "../inc/dbconn.inc.php"; 
$sql = "INSERT INTO notes(notes_content, user_id, machine_id) VALUES(?, ?, (SELECT id from machine where name=?));" ;
$statement = mysqli_stmt_init($conn);
$machine = htmlspecialchars($_POST['machine']);
mysqli_stmt_prepare($statement, $sql); 
mysqli_stmt_bind_param($statement, 'sss', htmlspecialchars($_POST["notes"]), $_SESSION["usersid"], $_POST['machine']); 
if (mysqli_stmt_execute($statement)){
    header("location: Edit-Machine.php?machine=$machine&search-box=");
}
else{
    mysqli_error($conn);
}
mysqli_close($conn);
?>
