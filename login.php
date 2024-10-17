<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] && $_SESSION["userrole"]){
    header("location: index.php");
    exit;
}

require_once "inc/dbconn.inc.php";

$username = $password = "";
$usernameErr = $passwordErr = $loginErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username not entered
    if (empty(trim($_POST["username"]))) {
        $usernameErr = "* Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }
    
    // Check if password not entered
    if (empty(trim($_POST["password"]))) {
        $passwordErr = "* Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // If username and password entered, check login
    if (empty($usernameErr) && empty($passwordErr)) {

        // Prepare sql statement
        $sql = "SELECT id, name, password, role_id FROM account WHERE username = ?";
        $statement = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($statement, $sql);
        mysqli_stmt_bind_param($statement, 's', $username);

        // Execute sql statement, retrieve user from database, check password
        if (mysqli_stmt_execute($statement)) {
            $account = mysqli_fetch_assoc(mysqli_stmt_get_result($statement));
            if ($account && $password == $account["password"]) {
                $_SESSION["loggedin"] = true;
                $_SESSION["userid"] = $account["id"];
                $_SESSION["username"] = $account["name"];
                $_SESSION["userrole"] = $account["role_id"];


                $session_id = session_id();
                $user_id = $account['id'];
                $role_id = $account['role_id'];
                $timestamp = date("Y-m-d H:i:s");

                $sql_insert_session = "INSERT INTO access_log (user_id, role, timestamp) VALUES (?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert_session);
                $stmt_insert->bind_param('iis', $user_id, $role_id, $timestamp);
                $stmt_insert->execute();
                $stmt_insert->close();

                header("location: index.php");
            } else {
                $loginErr = "Invalid username or password.";
            }
        } else {
            $loginErr = "Unable to perform login request, please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Smart Manufacturing Dashboard Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <link rel="stylesheet" href="Style/Main.css">
</head>
<body id="loginbody">
    <div id="login">
        <h1>Sign In</h1>

        <div class="iconContainer">
            <img src="Style/Images/user-solid.svg" alt="" class="icons">
        </div>
        
        <?php echo $loginErr;?><br>
        <form method="POST" action="login.php">
            <input type="text" id="username" name="username" value="<?php echo $username;?>" placeholder="Username"><br>
            <input type="password" id="password" name="password" value="<?php echo $password;?>" placeholder="Password"><br>
            <input type="submit" id="loginButton" value="Login">
        </form>
</body>
</html>