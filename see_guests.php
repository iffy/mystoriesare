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
<p><?php echo $fname; ?>, here are a list of the guests you have signed up and the stories
for which you have sgn them up.</p>

    <br>
        <a href="guest.php">Create a Guest Reader</a>
    <br>
    <br>

        <?php
            $sql = ("SELECT * FROM `guest` WHERE `userid` = '".$id."' ");
             $result = mysqli_query($db, $sql);
             echo "<table class='p'>";
             echo "<tr>";
             echo "<td class='z'>First Name</td>";
             echo "<td class='z'>Last Name</td>";
             echo "<td class='z'>Email</td>";
             echo "</tr>";
             while($row =mysqli_fetch_assoc($result)) {
            $g_id           = $row['g_id'];
            $first_name     = $row['first_name'];
            $last_name      = $row['last_name'];
            $email          = $row['email'];
                  echo "<tr>";
                  echo "<td>" .$first_name. "</td>";
                  echo "<td>" .$last_name. "</td>";
                  echo "<td>" .$email. "</td>";
                  echo "</tr>";
                  }
             echo "</table>";
        ?>
    <br>
    <br>
        


    </div>
</div>

<div class="footer">
    <?php include 'private/footer.php';?>