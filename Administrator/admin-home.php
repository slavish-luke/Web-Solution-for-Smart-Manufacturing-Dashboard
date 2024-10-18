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
    <link rel="stylesheet" type="text/css" href="../Style/Administrator.css">
    <link rel="stylesheet" type="text/css" href="../Style/Skeleton.css">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Administrator</title>
</head>

<header>
    <!--Home Button-->
    <div id="home-icon-div-admin">
        <a href="../Administrator/admin-home.php?search-box=">
            <img src="../Style/Images/home-button.svg" alt="home button image" id="Home-icon">
        </a>
    </div>

    <!--Welcome Message-->
    <div id="Welcome-message">
        <a href="../logout.php">
            <p>Welcome <?php echo("$_SESSION[username]"); ?>
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
                            <th class="access-list-header">Username</th>
                            <th class="access-list-header">Date</th>
                            <th class="access-list-header">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "../inc/dbconn.inc.php";
                        $sql = "
                        SELECT a.username, al.timestamp, r.name AS role 
                        FROM access_log al
                        JOIN account a ON al.user_id = a.id
                        JOIN role r ON al.role = r.id
                        ";
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

        <div id="stats-container">
                <h2>Dashboard Statistics</h2>
                    <table>
                        <thead>
                            <tr class="stats-tr">
                                <th class="statistics-header">Power consumption</th>
                                <th class="statistics-header">Production Count</th>
                            </tr>
                            <tr class="stats-tr">
                                <td class="chart-table-box">
                                    <div class="chart-container">
                                        <svg class="chart" viewBox="0 0 36 36">
                                            <circle class="background" r="16" cx="18" cy="18"></circle>
                                            <circle id="power-consumption-chart" class="foreground" r="16" cx="18" cy="18" stroke-dasharray="0 100" transform="rotate(-90 18 18)"></circle>
                                        </svg>
                                    </div>

                                    <div class="display-stats">
                                        <h3 id="power-consumption"></h3>
                                    </div>
                                </td>
                                <td class="chart-table-box">
                                    <div class="chart-container">
                                        <svg class="chart" viewBox="0 0 36 36">
                                            <circle class="background" r="16" cx="18" cy="18"></circle>
                                            <circle id="production-count-chart" class="foreground" r="16" cx="18" cy="18" stroke-dasharray="0 100" transform="rotate(-90 18 18)"></circle>
                                        </svg>
                                    </div>

                                    <div class="display-stats">
                                        <h3 id="production-count"></h3>
                                    </div>
                                </td>
                            </tr>
                            <tr class="stats-tr">
                                <th class="statistics-header">Average Temperature</th>
                                <th class="statistics-header">Average Speed</th>
                            </tr>
                            <tr class="stats-tr">
                                <td class="chart-table-box">
                                    <div class="chart-container">
                                        <svg class="chart" viewBox="0 0 36 36">
                                            <circle class="background" r="16" cx="18" cy="18"></circle>
                                            <circle id="average-temperature-chart" class="foreground" r="16" cx="18" cy="18" stroke-dasharray="0 100" transform="rotate(-90 18 18)"></circle>
                                        </svg>
                                    </div>
                                    
                                    <div class="display-stats">
                                        <h3 id="average-temperature"></h3>
                                    </div>
                                </td>
                                <td class="chart-table-box">
                                    <div class="chart-container">
                                        <svg class="chart" viewBox="0 0 36 36">
                                            <circle class="background" r="16" cx="18" cy="18"></circle>
                                            <circle id="average-speed-chart" class="foreground" r="16" cx="18" cy="18" stroke-dasharray="18.55 100" transform="rotate(-90 18 18)"></circle>
                                        </svg>
                                    </div>

                                    <div class="display-stats">
                                        <h3 id="average-speed"></h3>
                                    </div>
                                </td>
                            </tr>
                        </thead>
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
                        $sql = "SELECT a.id, a.username, a.password, a.name, a.email, a.notes, r.name AS role_name 
                                FROM account a 
                                JOIN role r ON a.role_id = r.id";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr onclick=\"openEditDialog(" . 
                                $row["id"] . ", '" . 
                                htmlspecialchars($row["username"]) . "', '" . 
                                htmlspecialchars($row["password"]) . "', '" . 
                                htmlspecialchars($row["name"]) . "', '" . 
                                htmlspecialchars($row["email"]) . "', '" . 
                                htmlspecialchars($row["role_name"]) . "', '" . 
                                htmlspecialchars($row["notes"]) . "')\" style='cursor: pointer;'>";
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
                <button class="btn-add-new-user" onclick="openAddUserDialog()">Add New User</button>
        </div>
        
    </div>

<div id="editUserDialog" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditDialog()">&times;</span>
        <h2 id="dialogTitle">Edit User</h2>
        <form id="editUserForm" method="POST" action="admin-user-update.php">
            <input type="hidden" name="id" id="userId">
            <input type="hidden" name="action" id="formAction">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" name="password" id="password" required>
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
                <label for="notes">Notes:</label>
                <textarea name="notes" id="notes"></textarea>
            </div>
            <div class="action-buttons">
                <input type="submit" value="Update User" class="btn-submit" id="submitButton" onclick="setAction('Update User')">
                <input type="button" value="Delete User" class="btn-delete" onclick="deleteUser()" style="display: none;" id="deleteButton">
            </div>
        </form>
    </div>
</div>

    <?php
        require_once "../inc/dbconn.inc.php";

        $sql = 
            "SELECT machine.id AS machine_id, machine.name AS machine_name, factory_log.*
            FROM machine 
            JOIN factory_log ON machine.id = factory_log.machine_id
            ORDER BY factory_log.timestamp DESC, machine.name;";

            if($result = mysqli_query($conn, $sql)){

                if(mysqli_num_rows($result) >= 1){
                    $factory_data = [];
                    
                    while ($row = mysqli_fetch_assoc($result)) {

                        $factory_data[$row['machine_id']]['machine_name'] = $row['machine_name'];
                        $factory_data[$row['machine_id']]['logs'][] = [
                            'timestamp' => $row['timestamp'],
                            'operational_status' => $row['operational_status'],
                            'error_code' => $row['error_code'],
                            'maintenance_log' => $row['maintenance_log'],
                            'power_consumption' => $row['power_consumption'],
                            'temperature' => $row['temperature'],
                            'production_count' => $row['production_count'],
                            'speed' => $row['speed'],
                            'pressure' => $row['pressure'],
                            'vibration' => $row['vibration'],
                            'humidity' => $row['humidity']
                        ];
                    }
                    mysqli_free_result($result);
                }
            }

        mysqli_close($conn);
    ?>
        <script type="text/javascript">
        let rawFactoryData = <?php echo json_encode($factory_data); ?>;
    </script>
    <script src="script.js" defer></script>
    
</body>
</html>