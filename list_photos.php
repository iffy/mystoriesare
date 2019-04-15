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
<p><?php echo "<p>".$fname." ".$lname." Your Photos</p>"; ?></p><br><br>

<p><a href="photo_upload.php">Upload a new photograph</a></p>

</div>
<br>
<?php
     $sql1 = "SELECT * FROM images WHERE userid = '$id' ";
     $result1 = mysqli_query($db, $sql1);

    echo "<table>";
    echo "<tr>";
    echo "<td class='y'>Your Picture Information </td>";
    echo "<td class='y'>&nbsp;&nbsp; Description</td>";
    echo "<td class='y'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date </td>";
    echo "<td class='y'> Thumbnail </td>";
    while($row1 =mysqli_fetch_assoc($result1)) {
    	$images_id        = $row1['images_id'];
        $userid         = $row1['userid'];
        $image_path     = $row1['image_path'];
        $date           = $row1['date'];
        $story_id       = $row1['story_id'];
        $image_name     = $row1['image_name'];
        $description    = $row1['description'];

    echo "<tr>";
    echo "<td>&nbsp;&nbsp;" .$image_name. "</td>";
    echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" .$description. "</td>";
    echo "<td>&nbsp;&nbsp;&nbsp;" .$date. "</td>";
    echo "<td hidden>" .$images_id. "</td>";
?>

    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo $image_path; ?>" alt="<?php echo $image_name; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="thumbnail"></td>
<?php
    echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;<a href='delete_photo.php?id=$images_id&name=$image_name'>Remove Photo Data</a></td>";
    echo "<tr>";
    }
    echo "</table>";
?>

    </div>
 </div>


<div class="footer">
<?php include 'private/footer.php';?>
