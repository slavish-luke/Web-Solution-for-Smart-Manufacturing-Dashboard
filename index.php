<?php
session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]){
    header("location: login.php");
    exit;
}

// Currently only goes to the production operator homepage
// Will redirect to the correct page for each role once the db is implemented
header("location: Production-Operators/home.php");
?>