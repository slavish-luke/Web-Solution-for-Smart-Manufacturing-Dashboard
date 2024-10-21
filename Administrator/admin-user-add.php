<?php
require_once "../inc/dbconn.inc.php"; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $notes = $_POST['notes'];
    $role_id = $_POST['role'];
    $sql = "INSERT INTO account (username, password, name, email, role_id, notes) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssis", $username, $password, $name, $email, $role_id, $notes);
    $stmt->execute();
    $stmt->close();
    header('location: admin-home.php');
}
?>