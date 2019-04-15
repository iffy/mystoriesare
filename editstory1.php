<?php include 'private/top.php'; ?>
<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
}
$id = $_SESSION["id"];


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate new story
    if(empty($_POST["story"])){
        $story_err = "Please Update new story.";
    } else{
        $story = $_POST["story"];
    }
      echo $story;

    // Validate confirm st_id
    if(empty(trim($_POST["st_id"]))){
        $st_id_err = "Please confirm story ID.";
    } else{
        $st_id = trim($_POST["st_id"]);
    }
      echo $st_id;

    // Check input errors before updating the database
    if(empty($story_err)&& empty($st_id_err)){
        // Prepare an update statement

        $sql_2 = ("UPDATE story SET story = ? WHERE st_id = ?");

        if($stmt = mysqli_prepare($db, $sql_2)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_story, $param_st_id);

            // Set parameters
            $param_story = $story;
            $param_st_id = $st_id;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                header("location: showstory.php");
                } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
     // Close connection
    //mysqli_close($db);
}
?>

        <div class="main">
            <div class="textwidth">
                <br>
                <br>
                 <?php
                 echo "Story ID:" .$st_id ."<br>";

                ?>
             </div>
        </div>
    </div>
</div>

<div class="footer">
<?php include 'private/footer.php';?>