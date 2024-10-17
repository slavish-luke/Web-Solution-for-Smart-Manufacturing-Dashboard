<?php
session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || $_SESSION["userrole"] != 4){
    header("location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="UTF-8" />
    <meta name="author" content="" />
    <meta http-equiv="Cache-control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="../Style/Production-Operators.css">
</head>
<body>
    
    <div id="header">
        <a href="home.php">Home</a>
        <a href="machines.php">Machines</a>
        <a href="jobs.php" class="selected">Jobs</a>
        <a href="notes.php">Notes</a>
    </div>


    <div class="main" id="jobs">
        <div id="job-list">
            <div class="content-pane">
                <div class="job-container" id="job0">
                    <span class="job-machine"></span>
                    <span class="job-description"></span>
                </div>
                <div class="job-container" id="job1">
                    <span class="job-machine"></span>
                    <span class="job-description"></span>
                </div>
                <div class="job-container" id="job2">
                    <span class="job-machine"></span>
                    <span class="job-description"></span>
                </div>
                <div class="job-container" id="job3">
                    <span class="job-machine"></span>
                    <span class="job-description"></span>
                </div>
                <div class="job-container" id="job4">
                    <span class="job-machine"></span>
                    <span class="job-description"></span>
                </div>
                <div class="job-container" id="job5">
                    <span class="job-machine"></span>
                    <span class="job-description"></span>
                </div>
                <div class="job-container" id="job6">
                    <span class="job-machine"></span>
                    <span class="job-description"></span>
                </div>
                <div class="job-container" id="job7">
                    <span class="job-machine"></span>
                    <span class="job-description"></span>
                </div>
            </div>
            <div class="navigation-pane">
                <button class="navbutton" id="prev-page">◀</button>
                <div id="current-page">1</div>
                <button class="navbutton" id="next-page">▶</button>
            </div>
        </div>
    </div>

    <?php
        require_once "../inc/dbconn.inc.php";

        $sql = "SELECT t.job_desc, m.name AS machine_name FROM task t LEFT JOIN machine m ON t.machine_id = m.id WHERE t.operator_id = " . $_SESSION["userid"];
        echo($sql);

        if($result = mysqli_query($conn, $sql)) {
            if(mysqli_num_rows($result) >= 1) {
                $tasks = [];

                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($tasks, $row);
                }
                mysqli_free_result($result);
            }
        }

        mysqli_close($conn);
    ?>
    <script type="text/javascript">
        let tasks = <?php echo json_encode($tasks); ?>;
    </script>
    <script src="script.js" defer></script></body>
</body>
</html>
