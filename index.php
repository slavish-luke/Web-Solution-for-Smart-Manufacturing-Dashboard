<?php
session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
    header("location: login.php");
    exit;
}

switch($_SESSION["userrole"]) {
    case 1:
        header("location: logout.php");
        // header("location: Auditor/home.php");                Replace line above once implemented
        break;
    case 2:
        header("location: logout.php");
        // header("location: Administrator/home.php");          Replace line above once implemented
        break;
    case 3:
        header("location: logout.php");
        // header("location: Factory-Managers/home.php");       Replace line above once implemented
        break;
    case 4:
        header("location: Production-Operators/home.php");
        break;
    default:
        header("location: logout.php");
}
?>