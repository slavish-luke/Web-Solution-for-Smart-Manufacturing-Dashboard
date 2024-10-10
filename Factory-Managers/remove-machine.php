<?php 


require_once "../inc/dbconn.inc.php"; 
$sql = "DELETE FROM machine WHERE id=?;" ;
$statement = mysqli_stmt_init($conn);
$machine = htmlspecialchars($_POST['machine']);
mysqli_stmt_prepare($statement, $sql); 
mysqli_stmt_bind_param($statement, 's', htmlspecialchars($_POST["removal"])); 
if (mysqli_stmt_execute($statement)){
    header("location: Home-screen.php?search-box=");
}
else{
    mysqli_error($conn);
}

?>