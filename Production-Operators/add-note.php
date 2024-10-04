<?php


    if (isset($_POST["machine-note"])) {
        require_once "../inc/dbconn.inc.php";
        
        $sql = "INSERT INTO notes(notes_content) VALUES(?);";
        
        $users = $_POST['users'];
        $machines = $_POST['machines'];
        $note = $_POST['machine-note'];

        $statement = mysqli_stmt_init($conn);

        mysqli_stmt_prepare($statement, $sql); 
        mysqli_stmt_bind_param($statement, 's', htmlspecialchars($_POST["machine-note"])); 
        // The 's' in mysqli_stmt_bind_param indicates a string parameter

        if(mysqli_stmt_execute($statement)){
            //header("location: notes.php"); 
            echo "<h1>MACHINES</h1><p>";
            print_r($machines);
            echo "</p>";
            
            echo "<h1>USERS</h1><p>";
            print_r($users);
            echo "</p>";

            echo "<h1>MACHINE NOTE</h1><p>";
            echo $note;
            echo "</p>";

            echo "<h1>All users</h1>";
            
            foreach($users as $user){
                if(!$machines){
                    echo "<p>User: ", $user, " no machines were selected Note: ", $note, "</p>";


                }else{
                    foreach($machines as $machine){
                        echo "<p>Machine: ", $machine, " User: ", $user, " Note: ", $note, "</p>";
    
                    }

                }
                
            };
        
        }else{
            echo mysqli_error($conn);
        }
    } 
    mysqli_close($conn);


?>