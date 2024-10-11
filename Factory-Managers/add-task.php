<?php 


require_once "../inc/dbconn.inc.php"; 
$sql = "INSERT INTO task (job_desc, operator_id, machine_id) VALUES (?, ?, ?);" ;
$statement = mysqli_stmt_init($conn);
$machine = htmlspecialchars($_POST['machine']);
mysqli_stmt_prepare($statement, $sql); 
mysqli_stmt_bind_param($statement, 'sss', htmlspecialchars($_POST["job-desc"]), $_POST['assigned-operator'], $_POST['machine']); 
if (mysqli_stmt_execute($statement)){
    header("location: Edit-Machine.php?machine=$machine&search-box=");
}
else{
    mysqli_error($conn);
}

?>