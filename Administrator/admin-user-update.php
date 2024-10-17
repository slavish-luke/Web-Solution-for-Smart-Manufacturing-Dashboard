<?php
require_once "../inc/dbconn.inc.php"; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $action = $_POST['action'];
    if ($action == 'Update User') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $notes = $_POST['notes'];
        $role_id = $_POST['role'];
        $sql = "UPDATE account SET username=?, password=?, name=?, email=?, notes=?, role_id=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $username, $password, $name, $email, $notes, $role_id, $id);
        $stmt->execute();
        $stmt->close();
        header('location: admin-home.php');
    } elseif ($action == 'Delete User') {
        $sql = "DELETE FROM account WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        header('location: admin-home.php');
    }
}
?>