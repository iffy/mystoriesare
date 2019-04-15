<?php include 'private/top.php'; ?>
<?php
  $st_id = $_GET['id'];

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

<div class="main">
    <div class="textwidth">

<div class="navbar1">
    <a href="showstory.php">Personal Home</a>
    <a href="writestory.php">Write Story</a>
    <a href="see_guests.php">Guests</a>
    <a href="sharestory.php">Share Stories</a>
    <a href="list_photos.php">Share Stories</a>
    <a href="logout.php">Logout</a>
</div>
</div>

<?php

    $userid = $id;

    $sql_1 = ("SELECT * FROM `story` WHERE `userid` = '".$userid."' AND `st_id` = '".$st_id."'");

    $result = mysqli_query($db, $sql_1);
    if($row =mysqli_fetch_assoc($result)){

                $st_name = $row['st_name'];
                $st_date = $row['st_date'];
                $st_email = $row['st_email'];
                $st_id = $row['st_id'];
                $story = $row['story'];
                $userid = $row['userid'];

 };
?>


        <div class="main">
            <div class="textwidth">
                <br>
                <br>
                <form action="<?php echo 'editstory1.php'; ?>" method="post">
                <table>
                    <tr>
                    <td>Story Name:</td>
                    <td><?php echo $st_name; ?></td>
                    </tr>
                    <tr>
                    <td>Story Date:</td>
                    <td><?php echo $st_date; ?></td>
                    </tr>
                    <tr>
                    <td colspan=2><input type="hidden" name="st_id" value="<?php echo $st_id; ?>"></td>
                    </tr>
                    <tr>
                    <td colspan=2><textarea class='b' name='story' placeholder='Begin your story here ...'><?php echo $story; ?></textarea></td>
                    </tr>
                    <tr>
                    <td><input type="submit" name"submit" value="Submit" class="button"></td>
                    <td></td>
                    </tr>
                </table>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="footer">
<?php include 'private/footer.php';?>