<?php include 'private/top.php'; ?>

<?php

if (is_post_request()) {
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = sha1($_POST['password']);
$password1 = sha1($_POST['password1']);


            if ($password != $password1) {redirect_to('login2.php' );  }

echo'<div class="main">';
echo '<div class="textwidth">';
echo     '<br>';
echo     '<br>';
echo     '<br>';

        echo "First Name:" . $first_name . "<br>";
        echo "Last Name:"   .$last_name . "<br>";
        echo "Password:"  . sha1($password) ."<br>";
        echo "Email:" . $email ."<br>";


        $sql = "Insert INTO profile (email, first_name, last_name, password) VALUES ('$email', '$first_name', '$last_name',";
        $sql .= "'$password')";
        $result = mysqli_query($db, $sql);
        redirect_to("write.php?id0=$email&id1=$password"."88742");

                if($result) {
                    return true;
                } else{
                    echo mysqli_error($db);
                    db_disconnect($db);
                    exit;
                }

    }else{
            redirect_to('login.php');
    }

?>
    </div>
</div>

<div class="footer">
    <?php include 'private/footer.php';?>