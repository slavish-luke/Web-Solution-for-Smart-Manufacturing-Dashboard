<?php
require_once "../inc/dbconn.inc.php"; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $action = $_POST['action'];
    if ($action == 'Update User') {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $role_id = $_POST['role'];
        $notes = $_POST['notes'];
        $sql = "UPDATE account SET username=?, name=?, email=?, notes=?, role_id=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $username, $name, $email, $notes, $role_id, $id);
        $stmt->execute();
        $stmt->close();
    } elseif ($action == 'Delete User') {
        $sql = "DELETE FROM account WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}
?>