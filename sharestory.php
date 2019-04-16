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
                <p><?php echo $fname; ?>, select the story and then the guests you would like to to share with them.</p>
            </div>
        <div>
        <form action="<?php echo 'sharestory1.php' ?>" method="post">
        <?php

                $sql = ("SELECT * FROM guest, story WHERE guest.userid = story.userid AND guest.userid = '$id' ");
                        $result = mysqli_query($db, $sql);
                                echo "<table class='p'>";
                                echo "<tr>";
                                echo "<td class='z'>Story Name</td>";
                                echo "<td class='z'>Email</td>";
                                echo "</tr>";
                                while($row = mysqli_fetch_assoc($result)) {
                                        $st_name = $row['st_name'];
                                        $email = $row['email'];
                                echo "<tr>";
                                echo "<td class='b'>".$st_name."</td>";
                                echo "<td><input type='checkbox' name='checkbox[]' class='checkboxes' value='$row[st_id],$row[g_id]' >" .$email."</td>";
                                echo "</tr>";
                                };
                                echo "<br>";
                                echo "</table>";
                                echo "<br>";
                                echo "<br>";
                echo "<input type='submit' name='submit' value='Submit' class='button'>";
                ?>
        </form>
        <?php
//}
        ?>
        </div>
    </div>

<div class="footer">
<?php include 'private/footer.php';?>