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


//Gather three things user id $id Guest id $g_id and story id $st_id
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

foreach ($_POST['st_name'] as $st_name);{
foreach ($_POST['checkbox'] as $value);{
    $breakout = $value;
    list($st_id, $g_id) = explode(',', $breakout);
    echo "story".trim($st_id) ."-"."guest". trim($g_id). "<br>";



        $sql = "INSERT INTO gs (id, st_id, userid) VALUES (?, ?, ?)";


                if($stmt = mysqli_prepare($db, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sss", $param_id, $param_st_id, $param_g_id);

                $param_id = $id;
                $param_st_id = $st_id;
                $param_g_id = $g_id;

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to start page
                    header("location: sharestory.php");

                } else{
                    echo "Something went wrong. Please try again later.";
                      }

                }
    }
    }
             // Close statement
            mysqli_stmt_close($stmt);


            // Close statement
            //mysqli_stmt_close($stmt);


       mysqli_close($db);
    }

?>

        <div class="main">
            <div class="textwidth">
                <br>
                <br>

             </div>
        </div>


<div class="footer">
<?php include 'private/footer.php';?>