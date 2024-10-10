<?php 


require_once "../inc/dbconn.inc.php"; 
$sql = "INSERT INTO machine (name, ison, img_address) VALUES (?, 0, ?);" ;
$statement = mysqli_stmt_init($conn);
$machine = htmlspecialchars($_POST['machine']);
mysqli_stmt_prepare($statement, $sql); 
mysqli_stmt_bind_param($statement, 'ss', htmlspecialchars($_POST["machine-name"]), $_POST['image-input']); 
if (mysqli_stmt_execute($statement)){
    header("location: Edit-Machine.php?machine=$machine&search-box=");
}
else{
    mysqli_error($conn);
}

?>