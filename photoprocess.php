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
    $currentDir = getcwd();

    $uploadDirectory = "\\uploads\\";

    $personalAddition = $id."-";

     $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions
    $fileName = $_FILES['myfile']['name'];
    $fileSize = $_FILES['myfile']['size'];
    $fileTmpName  = $_FILES['myfile']['tmp_name'];
    $fileType = $_FILES['myfile']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));
    $uploadPath = $currentDir . $uploadDirectory . $personalAddition . basename($fileName);

    //echo $uploadPath;

    if (isset($_POST['submit'])) {

        $param_storyid          = $_POST['st_id'];
        $param_picdate          = $_POST['picdate'];
        $param_filedescription  = $_POST['filedescription'];

        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
        }

        if ($fileSize > 1000000) {
            $errors[] = "This file is more than 1MB. Sorry, it has to be less than or equal to 1MB";
        }
        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
            if ($didUpload) {
             ?>
             <div class="main">
                <div class="textwidth">

                    <div class="navbar1">
                        <a href="showstory.php">Personal Home</a>
                        <a href="writestory.php">Write Story</a>
                        <a href="guest.php">Create Guest</a>
                        <a href="sharestory.php">Share Stories</a>
                        <a href="photo_upload.php">Photos</a>
                        <a href="logout.php">Logout</a>
                    </div>
                    <?php
                    // Check if story_name is empty
                        if(empty(trim($_POST["st_id"]))){
                                        $st_id_err = "Please enter a Story ID.";
                                } else{
                                        $st_id = trim($_POST["st_id"]);
                        }

                        // Check if story_date is empty
                        if(empty(trim($_POST["picdate"]))){
                                        $picdate_err = "Please enter a Picture Date.";
                                } else{
                                        $picdate = trim($_POST["$picdate"]);
                        }

                        // Check if story is empty
                        if(empty(trim($_POST["filedescription"]))){
                                        $filedescription_err = "Please enter a Picture Description.";
                                } else{
                                        $filedescription = trim($_POST["filedescription"]);
                        }

                // Check input errors before inserting in database
                if(empty($story_id_err) && empty($picdate_err) && empty($filedescription_err)){

                        $sql = "INSERT INTO images (userid, image_path, date, image_name, story_id, description) VALUES ( ?, ?, ?, ?, ?, ?)";

                        if($stmt = mysqli_prepare($db, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "ssssss", $id, $uploadPath, $param_picdate, $fileName, $param_storyid, $param_filedescription);

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                                // Redirect to login page
                                header("location: list_photos.php");
                        } else{
                                echo "Something went wrong. Please try again later.";
                                    }
                        }

                    }


                echo "The file " . basename($fileName) . " has been uploaded";
            } else {
                echo "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "These are the errors" . "\n";
            }
        }
    }

?>



            </div>


        </div>



<div class="footer">
    <?php include 'private/footer.php';?>