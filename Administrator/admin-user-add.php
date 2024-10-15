<?php
require_once "../inc/dbconn.inc.php"; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role_id = $_POST['role'];
    $notes = $_POST['notes'];
    $sql = "INSERT INTO account (username, name, email, role_id, notes) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssis", $username, $name, $email, $role_id, $notes);
    $stmt->execute();
    $stmt->close();
}
?>

