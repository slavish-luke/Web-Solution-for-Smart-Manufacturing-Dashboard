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
    <title>Notes</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Luke Kradolfer" />
    <meta http-equiv="Cache-control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="../Style/Production-Operators.css">
    <link type="image/png" sizes="16x16" rel="icon" href="../Style/Images/notes-favicon.png">
</head>
<body class="background">

    <div id="header">
        <a href="home.php">Home</a>
        <a href="machines.php">Machines</a>
        <a href="jobs.php">Jobs</a>
        <a href="notes.php" class="selected last">Notes</a>
    </div>


    <div class="main" id="notes">
        <form action="add-note.php" method="post">

            <div id="checklist-container"></div>
            <div id="user-container"></div>

            <div id="message-container">
                <h1>Task Notes</h1>

                <?php
                    // reading from the session storage 
                    // saves subject and note content if user forgot to pick recipients                
                    $subject = isset($_SESSION['subject']) ? $_SESSION['subject'] : ''; 
                    $note = isset($_SESSION['note']) ? $_SESSION['note'] : ''; 
                ?>

                <textarea name="note-subject" id="note-subject" placeholder="Subject" maxlength="38"><?php echo $subject; ?></textarea>
                <textarea name="note-content" id="note-content" placeholder="Type message here"><?php echo $note; ?></textarea>
                <input type="submit" id="submit-notes" value="Send notes">
            </div>
        </form>
    </div>

    <!-- modal box taken from: --> 
    <!-- https://www.w3schools.com/howto/howto_css_modals.asp -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="warning">
                <path d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"
                stroke="red" stroke-width="1.5vh"/>
            </svg>
            <p id="error-message">Some text in the Modal..</p>
        </div>
    </div>




    </div>
    <?php
        require_once "../inc/dbconn.inc.php";

        $sql = "SELECT m.*, a.name AS operator_name FROM machine m LEFT JOIN account a ON a.id = m.operator_id";

        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) >= 1){
                $machines = [];
                
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($machines, $row);
                }
                mysqli_free_result($result);
            }
        }

        $sql = 
        "SELECT username, id 
        FROM account 
        WHERE role_id = 3";

        if($result = mysqli_query($conn, $sql)){

            if(mysqli_num_rows($result) >= 1){
                $production_operator = [];
                
                while ($row = mysqli_fetch_assoc($result)) {

                    $production_operator[] = $row;
                };
                mysqli_free_result($result);
            }
        }
        mysqli_close($conn);


    ?>
    <script type="text/javascript">
        let machines = <?php echo json_encode($machines); ?>;
        let productionOperators = <?php echo json_encode($production_operator); ?>;
    </script>
    <script src="script.js" defer></script></body>
</body>
</html>