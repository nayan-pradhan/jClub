<?php
include_once 'head.php';
?>
<link rel="stylesheet" href="css/c.css">
<?php

include_once 'nav.php';

?>

<?php
require_once 'includes/dbh-in.php';
if (isset($_GET['name']) || isset($_GET['begin'])) {
    $name = $_GET['name'];
    $begin = $_GET['begin'];
    require_once 'includes/function-in.php';

    $name1 = mysqli_real_escape_string($conn, $name);
    $begin1 = mysqli_real_escape_string($conn, $begin);
    $sql = "SELECT * FROM STUDENT WHERE student_name='$name' AND student_DOB='$begin';";
    $result = mysqli_query($conn, $sql);
} else {

    $acid = $_SESSION['accid'];
    $sql = "SELECT * FROM MANAGES WHERE account_id='$acid';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $stid = $row['student_id'];
    $sql = "SELECT * FROM STUDENT WHERE student_id='$stid';";
    $result = mysqli_query($conn, $sql);
}


if ($row = mysqli_fetch_assoc($result)) {
    $studentinfo = $row;
    $stuid = $row['student_id'];
} else {
    header("location: index.php?error=nostudent");
    exit();
}

?>

<section id="yourClubLandingPage">
    <div class="right">
        <div id="members_name">
            <h2>Registered Clubs</h2>
            <ul class="dot">
                <?php
                $sid = $stuid;
                require_once 'includes/registeredcl-in.php';
                ?>
            </ul>
        </div>
    </div>
    <div class="left">
        <div class="intro">
            <h4>Student Info</h4>
            <!-- changes for each club after this -->
            <?php
            echo "<h1>" . $studentinfo["student_name"] . "</h1>";
            echo "Date of Birth: " . $studentinfo["student_DOB"] . "<br>";
            echo "Major: " . $studentinfo["student_major"] . "<br>";
            echo "Contact: " . $studentinfo["student_contact"] . "<br>";
            ?>
        </div>
        <?php
        if (isset($_SESSION['acctype'])) {
            if ($_SESSION['acctype'] == 'admin') {
                $_SESSION['sid'] = $stuid;
                echo "<form class='register-group' action='includes/register-in.php' method='post' style='padding-top:5%;'><label for='club_categories' class='label_text'>Category of Club: </label><br>
            <select id='club_categories' class='input-field' name='opt' required>";
                require_once 'includes/getallclub.php';
                echo "</select><button type='submit' class='btn btn-outline-warning submit-btn btn-sm' name='reg'>Register</button></form>";
            }
        }
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 'success') {
                echo "<p style='text-align:center; padding: 15px; color:green;font-size:13px;'>Successfully registered.</p>";
            } else if ($_GET['error'] == 'prestatefailed') {
                echo "<p style='text-align:center; padding: 15px; color:red;font-size:13px;'>Oops! Something is not right!</p>";
            } else if ($_GET['error'] == 'exec') {
                echo "<p style='text-align:center; padding: 15px; color:red;font-size:13px;'>Exec Failed!</p>";
            }
        }
        ?>
        <div class="activities">
            <h4>Upcoming Activities</h4>
            <ul class="dot">
                <?php
                require_once 'includes/upcoactivity-in.php';
                ?>
            </ul>
        </div>
</section>


<?php

include_once 'footer.php';

?>