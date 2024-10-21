<?php 


require_once "../inc/dbconn.inc.php"; 
$sql = "DELETE FROM note WHERE note_id = ?;" ;
$statement = mysqli_stmt_init($conn);
mysqli_stmt_prepare($statement, $sql); 
mysqli_stmt_bind_param($statement, 's', htmlspecialchars($_GET['deletion'])); 
if (mysqli_stmt_execute($statement)){
    header("location: Home-Screen.php?search-box=");
}
else{
    mysqli_error($conn);
}

?>