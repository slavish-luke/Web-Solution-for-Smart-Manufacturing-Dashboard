<?php
define("DB_HOST", "localhost");
define("DB_NAME", "dashboard");
define("DB_USER", "dbadmin");
define("DB_PASS", "");

$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$db) {
    // Something went wrong...
    echo "Error: Unable to connect to database.<br>";
    echo "Debugging errno: " . mysqli_connect_errno() . "<br>";
    echo "Debugging error: " . mysqli_connect_error() . "<br>";
    exit;
}