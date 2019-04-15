<?php include 'private/top.php'; ?>

<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["gloggedin"]) && $_SESSION["gloggedin"] === true){
    header("location: guestpage.php");
    exit;
}


// Define variables and initialize with empty values
$email = $gpassword = "";
$email_err = $gpassword_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Check if username is empty
        if(empty(trim($_POST["email"]))){
                $email_err = "Please enter Email.";
        } else{
                $email = trim($_POST["email"]);
        }

        // Check if password is empty
        if(empty(trim($_POST["gpassword"]))){
                $gpassword_err = "Please enter your password.";
        } else{
                $gpassword = trim($_POST["gpassword"]);
        }

        // Validate credentials
        if(empty($guestemail_err) && empty($gpassword_err)){
                // Prepare a select statement
                $sql = "SELECT g_id, email, password FROM guest WHERE email = ?";

                if($stmt = mysqli_prepare($db, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_email);

                        // Set parameters
                        $param_email = $email;

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                                // Store result
                                mysqli_stmt_store_result($stmt);

                                // Check if username exists, if yes then verify password
                                if(mysqli_stmt_num_rows($stmt) == 1){
                                        // Bind result variables
                                        mysqli_stmt_bind_result($stmt, $id, $email, $hashed_gpassword);
                                        if(mysqli_stmt_fetch($stmt)){
                                                if(password_verify($gpassword, $hashed_gpassword)){

                                                        // Password is correct, so start a new session
                                                        session_start();

                                                        // Store data in session variables
                                                        $_SESSION["gloggedin"] = true;
                                                        $_SESSION["id"] = $g_id;
                                                        $_SESSION["email"] = $email;

                                                        // Redirect user to welcome page
                                                        header("location: guestpage.php");
                                                } else{
                                                        // Display an error message if password is not valid
                                                        $gpassword_err = "The password you entered was not valid.";
                                                }
                                        }
                                } else{
                                        // Display an error message if username doesn't exist
                                        $email_err = "No account found with that Email.";
                                }
                        } else{
                                echo "Oops! Something went wrong. Please try again later.";
                        }
                }

                // Close statement
                mysqli_stmt_close($stmt);
        }

        // Close connection
        mysqli_close($link);
}
?>
    <div class="main">
        <div class="textwidth">
                <h2>Login</h2>
                <p>Please fill in your credentials to login.</p>
                <form action="guestlogin.php" method="post">
                    <table>
                           <tr>
                               <td><label>Guest Email</label></td>
                               <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
                           </tr>
                           <tr>
                               <td><label>Password</label></td>
                               <td><input type="password" name="gpassword" value="<?php echo $gpassword; ?>"></td>
                           </tr>
                           <tr>
                               <td><input type="submit" name"submit" value="Login" class="button"></td>
                               <td></td>
                           </tr>

                       </table>
                </form>
        </div>
    </div>

<div class="footer">
<?php include 'private/footer.php';?>