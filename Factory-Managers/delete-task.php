<?php 


require_once "../inc/dbconn.inc.php"; 
$sql = "DELETE FROM task WHERE id = ?;" ;
$statement = mysqli_stmt_init($conn);
$note = htmlspecialchars($_GET['machine']);
mysqli_stmt_prepare($statement, $sql); 
mysqli_stmt_bind_param($statement, 's', htmlspecialchars($_GET['deletion'])); 
if (mysqli_stmt_execute($statement)){
    header("location: Edit-Machine.php?machine=$note&search-box=");
}
else{
    mysqli_error($conn);
}

?>