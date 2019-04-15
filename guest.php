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
// Include config file


// Define variables and initialize with empty values

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
<p><?php echo $fname; ?>, please fill out a guest page for each person with would whom you would like to share your stories.</p>
</div>
<br>

<?php

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $param_firstname = trim($_POST["first_name"]);
    $param_lastname = trim($_POST["last_name"]);
    $param_email = trim($_POST["email"]);
    $param_userid = $id;


    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }


    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO guest (first_name, last_name, email, userid, password) VALUES (?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_firstname, $param_lastname, $param_email, $param_userid, $param_password);

            // Set parameters
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash


            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: guest.php");
            } else{
                echo "Something went wrong. Please try again later. LAST";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($db);
}

?>
<div class="main">
    <div class="textwidth">
        <form action="<?php echo 'guest.php' ?>" method="post">
                <table>
                    <tr>
                        <td>First Name:</td>
                        <td><input type="text" name="first_name"/></td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td><input type="text" name="last_name"/></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="text" name="email"/></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password"/></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="confirm_password" /></td>
                    </tr>
                </table>
                    <input type="submit" name="submit" value="Submit" class="button">
                </form>
        </div>
    </div>
</div>
<div class="footer">
<?php include 'private/footer.php';?>