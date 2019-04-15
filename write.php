<?php include "private/top.php";?>

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


};
};
?>

<div class="main">
    <div class="textwidth">
        <br>
        <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">x</a>
            <a href="write.php">Personal Home</a>
            <a href="writestory.php">Write A Story</a>
            <a href="showstory.php">Show Your Stories</a>
            <a href="logout.php">Logout</a>
        </div>

        <div id="main">
            <button class="openbtn" onclick="openNav()">&#9776 Your Menu</button>
            <h2>Welcome, <?php echo $fname; ?> this is your private writing space</h2>
        </div>

        <script>
            function openNav() {
                document.getElementById("mySidebar").style.width = "200px";
                document.getElementById("main").style.marginLeft = "200px";
            }

            function closeNav() {
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("main").style.marginLeft= "0";
            }
        </script>


    </div>

</div>

<div class="footer">
<?php include 'private/footer.php';?>

