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
$sql = "SELECT * FROM CLUB WHERE club_name='$name' AND club_begin='$begin'";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    $clubinfo = $row;
    $clubid = $row['club_id'];
} else {
    header("location: index.php?error=noclub");
    exit();
}

?>

<section id="yourClubLandingPage">
    <div class="right">
        <div id="moderators_name">
            <h2>Moderators</h2>
            <ul class="dot">
                <li>Name of Moderator 1</li>
                <li>Name of Moderator 2</li>
                <li>Name of Moderator 3</li>
            </ul>
        </div>
        <br>
        <div id="members_name">
            <h2>Members</h2>
            <ul class="dot">
                <?php
                $cid = $clubid;
                require_once 'includes/meminfsearch.php';
                ?>
            </ul>
        </div>
    </div>
    <div class="left">
        <div class="intro">
            <h4>Club Space</h4>
            <!-- changes for each club after this -->
            <?php
            echo "<h1>" . $clubinfo["club_name"] . "</h1>";
            echo "Contact: " . $clubinfo["club_contact"] . "<br>";

            if ($clubinfo['sports'] == 1) {
                echo "Club Category: Sports";
            } else if ($clubinfo['other_clubs'] == 1) {
                echo "Club Category: Others";
            } else if ($clubinfo['arts'] == 1) {
                echo "Club Category: Arts";
            } else if ($clubinfo['dance'] == 1) {
                echo "Club Category: Dance";
            } else if ($clubinfo['outreach_and_fellowship'] == 1) {
                echo "Club Category: Outreach and Fellowship";
            }
            $_SESSION['clubid'] = $clubinfo['club_id'];
            ?>
        </div>
        <div class="clubDescription">
            <h3>Club Description</h3>
            <?php
            echo $clubinfo['club_description'];
            ?>
        </div>
        <div class="activities">
            <h4>Activities</h4>
            <ul class="dot">
                <?php
                require_once 'includes/activinfosearch.php';
                if (mysqli_num_rows($clubidres) == 0) {
                    echo "<li style='color:red;'>No activity yet!</li>";
                }
                ?>
            </ul>
        </div>
    </div>

</section>


<?php

include_once 'footer.php';

?>