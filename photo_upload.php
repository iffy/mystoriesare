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

      $sql1 = ("SELECT * FROM `users` WHERE `id` = '$id' ");
        $result1 = mysqli_query($db, $sql1);

        if ($result1->num_rows > 0) {
                while($row = $result1->fetch_assoc()) {
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
    <br>
    Welcome <?php echo $fname; ?>, select an image and match it with a story you have already written.
     <form action="photoprocess.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Select File:</td>
                <td><input type="file" name="myfile" id="fileToUpload"></td>
            </tr>
            <tr>
                <td>Choose Story: </td>
                <td>
                    <select name="st_id">
                    <?php
                    $sql2 = ("SELECT * FROM `story` WHERE `userid` = '$id' ");
                    //database connection is already made and called $db
                     $result2 = mysqli_query($db, $sql2);
                    while($row =mysqli_fetch_assoc($result2)) {
                        $st_id      = $row['st_id'];
                        $st_name    = $row['st_name'];
                        $st_date    = $row['st_date'];
                        $st_email   = $row['st_email'];
                        $userid     = $row['userid'];
                        ?>

                        <option value = "<?php echo $st_id; ?>"> <?php echo $st_name ?><?php $st_id ?> </option>;

                        <?php
                        };
                         ?>

                    </select>
                </td>
            </tr>
            <tr>
                <td>Picture Date:</td>
                <td><input type="text" name="picdate" value="" /></td>
            </tr>
            <tr>
                 <td>File Discription:</td>
                 <td><input type="text" name="filedescription" value="" /></td>
            </tr>
            <tr>
                 <td><input type="submit" name="submit" value="Upload File Now" ></td>
            </tr>
        </table>
    </form>
            <script src="upload.js"></script>
    </div>
</div>

<div class="footer">
<?php include 'private/footer.php';?>