<?php
include("../inc/dbconn.inc.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $sql = "UPDATE account SET username=?, name=?, email=?, role_id=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssiii', $username, $name, $email, $role, $id);
    $stmt->close();
    $conn->close();
    header('Location: admin-home.php');
}
?>