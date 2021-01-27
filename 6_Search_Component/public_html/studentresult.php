<?php
include_once 'head.php';
?>
<link rel="stylesheet" href="css/c.css">
<?php

include_once 'nav.php';

?>

<?php
if ($_GET['name'] || $_GET['begin']) {
    $name = $_GET['name'];
    $begin = $_GET['begin'];
}
require_once 'includes/dbh-in.php';
require_once 'includes/function-in.php';

$name1 = mysqli_real_escape_string($conn, $name);
$begin1 = mysqli_real_escape_string($conn, $begin);
$sql = "SELECT * FROM STUDENT WHERE student_name='$name' AND student_DOB='$begin'";
$result = mysqli_query($conn, $sql);

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