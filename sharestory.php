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

$sql = "SELECT * FROM users WHERE id = $_SESSION[id] ";
$result = mysqli_query($db, $sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $username = $row["username"];
        $fname    = $row["fname"];
    }
}

?>
    <div class="main">
            <div class="textwidth">

                <?php include 'private/navbar1.php'; ?>
        <br>
                <p><?php echo $fname; ?>, select the story and then the guests you would like to to share with them.</p>
            </div>
        <div>

        <form action="<?php echo 'sharestory1.php' ?>" method="post">
        <?php

        echo "<table class='p'>";
            echo "<tr>";
            echo "<td class='u'> Stories your Guest can Read </td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><br></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td class='z'>Guest Name</td>";
            echo "<td class='z'>Story Name</td>";
            echo "</tr>";

                $sql = ("SELECT * FROM gs WHERE id = $id");
                $result = mysqli_query($db, $sql);

                while($row = mysqli_fetch_array($result)) {
                    $firstname     = $row['first_name'];
                    $lastname      = $row['last_name'];
                    $storyname     = $row['story_name'];
                    $stid          = $row['st_id'];
                    $storyname     = $row['story_name'];

                echo "<tr>";
                echo "<td>".$firstname." ".$lastname."</td>";
                echo "<td>".$storyname."</td>";
                echo "</tr>";
                }
        echo "</table>";
        echo "<br>";
        echo "<br>";

        $sql = ("SELECT
                    story.st_name,
                    story.st_id,
                    guest.g_id,
                    guest.email,
                    guest.first_name,
                    guest.last_name,
                    gs.id as already_shared
                FROM
                    guest,
                    story
                    LEFT JOIN gs
                        ON gs.id = $id
                        AND gs.st_id = story.st_id
                        AND gs.guest_id = guest.g_id
                WHERE
                    story.userid = $id
                    AND guest.userid = $id
                    AND 
                ORDER BY story.st_name");
        $result = mysqli_query($db, $sql);

        echo "<table class='p'>";
            echo "<tr>";
            echo "<td class='z'>Story Name</td>";
            echo "<td class='z'>Email</td>";
            echo "</tr>";

                while($row = mysqli_fetch_array($result)) {
                    $st_name    = $row['st_name'];
                    $email      = $row['email'];
                    $st_id      = $row['st_id'];
                    $g_id       = $row['g_id'];
                    $first_name = $row['first_name'];
                    $last_name  = $row['last_name'];
                    $already_shared = $row['already_shared'];

                    if (is_null($already_shared)) {
                        echo "<tr>";
                        echo "<td class='b'>".$st_name."</td>";
                        echo "<td><input type='checkbox' name='checkbox[]' class='checkboxes' value='$row[st_id],$row[g_id],$row[first_name],$row[last_name],$row[st_name]' >".$email."</td>";
                        echo "</tr>";
                    }
                }

        echo "<br>";
        echo "</table>";
        echo "<br>";
        echo "<br>";

        echo "<input type='submit' name='submit' value='Submit' class='button'>";
        ?>

        </form>


        </div>
    </div>

<div class="footer">
<?php include 'private/footer.php';?>

