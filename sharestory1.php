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

$value_array[]  = $_POST['value'];

foreach($value_array as $value){
    $breakout = $value;
    list($stid1, $gid1) = explode(',', $breakout);
    echo "story".trim($stid1) ."-"."guest". trim($gid1). "\n";
    }




    // Check if story_id is empty
    if(empty($stid1)){
        $stid1_err = "Please enter a Story ID.";
        } else{
        $stid1_array = $stid1;
        }

    // Check if guest_id is empty
    if(empty($gid1)){
        $gid1_err = "Please enter a Guest ID.";
        } else{
        $gid1_array = $gid1;
        }


/*      //First Array Story
    foreach($st_id_array as $stid){

        // Second Array Guest
        foreach($userid_array as $userid){

        $sql = "INSERT INTO gs (id, st_id, userid) VALUES (?, ?, ?)";

            // Check input errors before inserting in database
            if(empty($userid_array_err) && empty($id) && empty($st_id_err)){



                if($stmt = mysqli_prepare($db, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "iii", $id, $stid, $userid);

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to start page
                    header("location: showstory.php");

                } else{
                    echo "Something went wrong. Please try again later.";
                      }

                }
              // Close statement
            mysqli_stmt_close($stmt);
            }

            // Close statement
            //mysqli_stmt_close($stmt);
        }

    }

       //mysqli_stmt_close($stmt);
*/
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