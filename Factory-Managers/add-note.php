<?php
session_start();
require_once "../inc/dbconn.inc.php"; 
$sql = "UPDATE machine SET note = ? WHERE id=?" ;
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


if (htmlspecialchars($_POST['status-button'] == 'active')){
    $sql = "UPDATE machine SET operational_status = 'active' WHERE id=?" ;
    $statement = mysqli_stmt_init($conn);
    $machine = htmlspecialchars($_POST['machine']);
    mysqli_stmt_prepare($statement, $sql); 
    mysqli_stmt_bind_param($statement, 's', $_POST['machine']); 
    if (mysqli_stmt_execute($statement)){
        header("location: Edit-Machine.php?machine=$machine&search-box=");
    }
    else{
        mysqli_error($conn);
    }
}
else if (htmlspecialchars($_POST['status-button'] == 'idle')){
    $sql = "UPDATE machine SET operational_status = 'idle' WHERE id=?" ;
    $statement = mysqli_stmt_init($conn);
    $machine = htmlspecialchars($_POST['machine']);
    mysqli_stmt_prepare($statement, $sql); 
    mysqli_stmt_bind_param($statement, 's', $_POST['machine']); 
    if (mysqli_stmt_execute($statement)){
        header("location: Edit-Machine.php?machine=$machine&search-box=");
    }
    else{
        mysqli_error($conn);
    }
}

else if (htmlspecialchars($_POST['status-button'] == 'maintenance')){
    $sql = "UPDATE machine SET operational_status = 'maintenance' WHERE id=?" ;
    $statement = mysqli_stmt_init($conn);
    $machine = htmlspecialchars($_POST['machine']);
    mysqli_stmt_prepare($statement, $sql); 
    mysqli_stmt_bind_param($statement, 's', $_POST['machine']); 
    if (mysqli_stmt_execute($statement)){
        header("location: Edit-Machine.php?machine=$machine&search-box=");
    }
    else{
        mysqli_error($conn);
    }
}

if (htmlspecialchars($_POST["image-input"]) !== ""){
    $sql = "UPDATE machine SET img_address = ? WHERE id=?" ;
    $statement = mysqli_stmt_init($conn);
    $machine = htmlspecialchars($_POST['machine']);
    mysqli_stmt_prepare($statement, $sql); 
    mysqli_stmt_bind_param($statement, 'ss', htmlspecialchars($_POST["image-input"]), $_POST['machine']); 
    if (mysqli_stmt_execute($statement)){

        header("location: Edit-Machine.php?machine=$machine&search-box=");
    }
    else{
        mysqli_error($conn);
    }
}

$sql = "UPDATE machine SET operator_id = ? WHERE id=?" ;
$statement = mysqli_stmt_init($conn);
$machine = htmlspecialchars($_POST['machine']);
mysqli_stmt_prepare($statement, $sql); 
mysqli_stmt_bind_param($statement, 'ss', htmlspecialchars($_POST["machine-operator"]), $_POST['machine']); 
if (mysqli_stmt_execute($statement)){
    header("location: Edit-Machine.php?machine=$machine&search-box=");
}
else{
    mysqli_error($conn);
}

mysqli_close($conn);
?>
