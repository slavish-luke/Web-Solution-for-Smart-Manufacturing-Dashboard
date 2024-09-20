<!DOCTYPE html>
<html lang="en">
<head>
    <title>factorylogs test</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Luke Kradolfer" />
    <!-- <script src="scripts/script.js" defer></script> -->
</head>
<body>
    <h1>Machine names</h1>
    <?php
        require_once "../inc/dbconn.inc.php";

        $sql = "SELECT id, machine_name FROM factory_logs;";

        if($result = mysqli_query($conn, $sql)){

            if(mysqli_num_rows($result) >= 1){
                $counter = 0;
                
                echo "<ul>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>" . $row["machine_name"] . "</li>";
                    
                    $counter++;

                    if($counter > 10){
                        break;
                    }
                }
                echo "</ul>";
                mysqli_free_result($result);
            }
        }
        mysqli_close($conn);

        
    ?>
</body>
</html>
