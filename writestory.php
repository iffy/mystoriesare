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

$sql = "SELECT * FROM users WHERE id = '$id' ";
$result = mysqli_query($db, $sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    $username = $row["username"];
    $password = $row["password"];
    $fname     = $row["fname"];
    $lname     = $row["lname"];
    $email     = $row["email"];



};
};
?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $param_story_name = $_POST['story_name'];
    $param_story_date = $_POST['story_date'];
    $param_story      = $_POST['story'];
    $param_email      = $email;
    $param_userid     = $id;
    $param_image      = $image;


            // Check if story_name is empty
            if(empty(trim($_POST["story_name"]))){
                    $story_name_err = "Please enter a Story Name.";
                } else{
                    $story_name = trim($_POST["story_name"]);
            }

            // Check if story_date is empty
            if(empty(trim($_POST["story_date"]))){
                    $story_date_err = "Please enter a Story Date.";
                } else{
                    $story_date = trim($_POST["story_date"]);
            }

            // Check if story is empty
            if(empty(trim($_POST["story"]))){
                    $story_err = "Please enter a Story.";
                } else{
                    $story = trim($_POST["story"]);
            }

        // Check input errors before inserting in database
        if(empty($story_name_err) && empty($story_date_err) && empty($story_err)){

            $sql = "INSERT INTO story (st_name, st_date, st_email, story, userid) VALUES (?, ?, ?, ?, ?)";

            if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_story_name, $param_story_date, $param_email, $param_story, $param_userid);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: showstory.php");
            } else{
                echo "Something went wrong. Please try again later.";
                  }
            }

    }
    }
?>

<div class="main">
    <div class="textwidth">

<div class="navbar1">
    <a href="showstory.php">Personal Home</a>
    <a href="writestory.php">Write Story</a>
    <a href="see_guests.php">Guests</a>
    <a href="sharestory.php">Share Stories</a>
    <a href="list_photos.php">Photos</a>
    <a href="logout.php">Logout</a>
</div>
<br>
<p><?php echo $fname; ?>, here you can write your story and save it in the database. From there you can read or edit the story. Do
not feel like to must write the story all at once. Also, be aware that you can write the story in another medium, like Word and then
paste in into this page. Please enter a <i>Story Date</i> and a <i>Story Name</i> for each story you write.</p>
</div>
<br>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <table>
                    <tr>
                        <td>First Name:</td>
                        <td><?php echo "$fname" ?></td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td><?php echo "$lname" ?></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><?php echo "$email" ?></td>
                    </tr>
                    <tr>
                        <td>Story Name:</td>
                        <td><input type="text" name="story_name"/></td>
                    </tr>
                    <tr>
                        <td>Story Image:</td>
                        <td><input type="text" name="image_name"/></td>
                    </tr>
                    <tr>
                        <td>Story Date:</td>
                        <td><input type="text" name="story_date" /></td>
                    </tr>
                </table>
                    <textarea name="story" placeholder="Begin your story here ..."></textarea><br>
                    <input type="submit" name="submit" value="Submit" class="button">
                </form>
            </div>


    </div>
</div>

<div class="footer">
    <?php include 'private/footer.php';?>