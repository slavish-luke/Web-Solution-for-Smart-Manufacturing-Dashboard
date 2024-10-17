<?php 


require_once "../inc/dbconn.inc.php"; 
$sql = "INSERT INTO machine (name, operational_status, img_address, operator_id) VALUES (?, 'active', ?, ?);" ;
$statement = mysqli_stmt_init($conn);
$machine = htmlspecialchars($_POST['machine']);
mysqli_stmt_prepare($statement, $sql); 
mysqli_stmt_bind_param($statement, 'sss', htmlspecialchars($_POST["machine-name"]), $_POST['image-input'], $_POST['creation-operator']); 
if (mysqli_stmt_execute($statement)){
    header("location: Edit-Machine.php?machine=$machine&search-box=");
}
else{
    mysqli_error($conn);
}

?>