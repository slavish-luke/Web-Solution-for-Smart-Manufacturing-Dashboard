<?php
session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || $_SESSION["userrole"] != 1){
    header("location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Oliver Volk">
    <link rel="stylesheet" type="text/css" href="../Style/Skeleton.css">
    <link rel="stylesheet" type="text/css" href="../Style/Administrator.css">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Administrator</title>
</head>

<header>
    <!--Home Button-->
    <div>
        <a href="../Administrator/admin-home.php?search-box=">
            <img src="../Style/Images/home-button.svg" alt="home button image" id="Home-icon">
        </a>
    </div>

    <!--Welcome Message-->
    <div id="Welcome-message">
        <a href="../logout.php">
            <p>Welcome <?php session_start(); echo("$_SESSION[username]"); ?>
            </p>
        </a>
    </div>

    <!--Settings Button-->
    <div>
        <details id="settings-dropdown">
            <summary>
            <img src="../Style/Images/settings-cog.svg" alt="Settings cog" id="Settings-icon">
            </summary>
            <a href="../logout.php">Logout</a>
        </details>
    </div>
    
</header>

<body>
<h1>Administrator Overview</h1>
    <div id="quick-view">
        <div id="monitor-access">
            <h2>Dashboard Access List</h2>
                <table>
                    <thead class="access-list-table">
                        <tr>
                            <th class="access-list-header">Name</th>
                            <th class="access-list-header">Date</th>
                            <th class="access-list-header">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "../inc/dbconn.inc.php";
                        $sql = "SELECT username, timestamp, role FROM access_log";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                    echo "<td>" . $row["username"] . "</td>";
                                    echo "<td>" . $row["timestamp"] . "</td>";
                                    echo "<td>" . $row["role"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No access data available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>  
        </div>
        <div id="user-management">
            <h2>User Management</h2>
                <table>
                    <thead class="management-list-table">
                        <tr>
                            <th class="management-list-header">Username</th>
                            <th class="management-list-header">Name</th>
                            <th class="management-list-header">Email</th>
                            <th class="management-list-header">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT a.id, a.username, a.name, a.email, r.name AS role_name 
                                FROM account a 
                                JOIN role r ON a.role_id = r.id";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr onclick=\"openEditDialog(" . $row["id"] . ", '" . htmlspecialchars($row["username"]) . "', '" . htmlspecialchars($row["name"]) . "', '" . htmlspecialchars($row["email"]) . "', '" . htmlspecialchars($row["role_name"]) . "')\" style='cursor: pointer;'>";
                                echo "<td>" . $row["username"] . "</td>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td>" . $row["role_name"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No users found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
    </div>

<div id="editUserDialog" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditDialog()">&times;</span>
        <h2>Edit User</h2>
        <form id="editUserForm" method="POST" action="admin-user-update.php">
            <input type="hidden" name="id" id="userId">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role" id="role" required>
                    <option value="1">Administrator</option>
                    <option value="2">Auditor</option>
                    <option value="3">Factory Manager</option>
                    <option value="4">Production Operator</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Update User" class="btn-submit">
            </div>
        </form>
    </div>
</div>

    <?php
        mysqli_close($conn);
    ?>
    <script src="script.js" defer></script>
</body>
</html>