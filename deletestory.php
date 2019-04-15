<?php include 'private/top.php'; ?>
<?php

$st_id = $_GET["id"];

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
}
$id = $_SESSION["id"];


// Check connection
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Attempt delete query execution
$sql = "DELETE FROM story WHERE st_id = ?";



if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_st_id);

            // Set parameters
            $param_st_id = $st_id;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                header("location: showstory.php");
                } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

// Close connection
mysqli_close($db);
?>