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

?>

<?php



// must have an image name
  if(empty($_GET['id'])) {
  	redirect_to('list_photos.php');
  }

$images_id =  $_GET['id'];
$image_name = $_GET['name'];

$file = "uploads\\".$id."-".$image_name;

echo $images_id. "-" .$id. "-" .$image_name. "-" .$file;

 	$sql = "DELETE FROM images WHERE images_id = ? and userid = ?";
    if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $images_id, $id);

            // Set parameters
            $param_images_id = $images_id;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                if (file_exists($file)) {
        		unlink($file); // Delete now
    			}
                header("location: list_photos.php");
                } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }




// Close connection
mysqli_close($db)
?>

