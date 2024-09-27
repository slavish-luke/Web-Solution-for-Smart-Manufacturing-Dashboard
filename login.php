<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]){
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
        $sql = "SELECT username, password FROM account WHERE username = ?";
        $statement = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($statement, $sql);
        mysqli_stmt_bind_param($statement, 's', $username);

        // Execute sql statement, retrieve user from database, check password
        if (mysqli_stmt_execute($statement)) {
            $account = mysqli_fetch_assoc(mysqli_stmt_get_result($statement));
            if ($account && $password == $account["password"]) {
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $account["username"];

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
    <title>Dashboard Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php echo $loginErr;?><br>
    <form method="POST" action="login.php">
        <input type="text" name="username" value="<?php echo $username;?>" placeholder="Username"><br>
        <input type="text" name="password" value="<?php echo $password;?>" placeholder="Password"><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>