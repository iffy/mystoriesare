<?php include 'private/top.php'; ?>
<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["gloggedin"]) || $_SESSION["gloggedin"] !== true){
    header("location: guestlogin.php");
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
            <a href="logout.php">Logout</a>
        </div>
        <br>
        <p>Welcome, guest this is your private writing space where you will find stories that have
        been written by other for you to read. Please enjoy them.</p>
        </div>
        <br>
        <?php

             $sql = ("SELECT * FROM `story` WHERE `userid` = '".$id."' ");
             $result = mysqli_query($db, $sql);
             //$row =mysqli_fetch_assoc($result);
             echo "<table class='p'>";
             while($row =mysqli_fetch_assoc($result)) {

                $st_name = $row['st_name'];
                $st_date = $row['st_date'];
                $st_email = $row['st_email'];
                $st_id = $row['st_id'];
                $story = $row['story'];
                $userid = $row['userid'];

                  echo "<form action='editstory.php' method='post'>";
                  echo "<tr>";
                  echo "<td class='u'>Story Name:</td>";
                  echo "<td class='b'>" .$st_name. "</td>";
                  echo "<td>&nbsp;&nbsp;&nbsp;<a href='readstory.php?id=$st_id' >Read</a></td>";
                  echo "<td>&nbsp;&nbsp;&nbsp;<a href='editstory.php?id=$st_id' >Edit</a></td>";
                  echo "<td>&nbsp;&nbsp;&nbsp;<a href='deletestory.php?id=$st_id' >Delete</a></td>";
                  echo "</tr>";
                  echo "</form>";
                  }
             echo "</table>";
        ?>

    </div>
</div>

<div class="footer">
<?php include 'private/footer.php';?>l>