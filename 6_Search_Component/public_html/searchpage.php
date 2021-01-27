<?php
include_once 'head.php';
?>
<link rel="stylesheet" href="css/card.css">
<!--google-fonts-->
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<?php

include_once 'nav.php';

?>

<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'illegal') {
    } else if ($_GET['error'] == 'illegal') {
        echo "<h4>No result!</h4>";
    }
}
?>

<section id="cards">
    <?php
    require_once 'includes/dbh-in.php';

    if (isset($_POST['search'])) {
        if ($_POST['searchword'] != NULL) {
            $value = mysqli_real_escape_string($conn, strip_tags($_POST['searchword']));
            $sql = "SELECT * FROM CLUB WHERE club_name LIKE '%$value%' OR club_description LIKE '%$value%' OR
                    club_begin LIKE '%$value%' OR club_contact LIKE '%$value%';";
            $result = mysqli_query($conn, $sql);
            $nore = mysqli_num_rows($result);

            if ($nore == 0) {
                $sql = "SELECT * FROM ACTIVITY WHERE activity_name LIKE '%$value%' OR activity_location LIKE '%$value%' OR
                    activity_desc LIKE '%$value%' OR activity_type LIKE '%$value%' OR activity_day LIKE '%$value%' OR activity_time LIKE '%$value%';";
                $result = mysqli_query($conn, $sql);
                $nore = mysqli_num_rows($result);
                if ($nore > 0) {
                    $row1 = mysqli_fetch_assoc($result);

                    //to find clubid of activity
                    $sql1 = "SELECT * FROM ORGANIZES WHERE activity_id=?;";
                    $prestate1 = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($prestate1, $sql1);

                    mysqli_stmt_bind_param($prestate1, "i", $row1['activity_id']);
                    mysqli_stmt_execute($prestate1);

                    //we get the result 
                    $resultdata = mysqli_stmt_get_result($prestate1);
                    $clubi = mysqli_fetch_assoc($resultdata); //associating the result 
                    $clubid = $clubi['club_id'];
                    mysqli_stmt_close($prestate1);

                    $sql2 = "SELECT * FROM CLUB WHERE club_id=?;";
                    $prestate2 = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($prestate2, $sql2);

                    mysqli_stmt_bind_param($prestate2, "i", $clubid);
                    mysqli_stmt_execute($prestate2);
                    //we get the result 
                    $result = mysqli_stmt_get_result($prestate2);
                }
            }

            if ($nore > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='card mb-3' style='max-width: 18rem;color:white;background-color:#202945'>
  <a href='result.php?name=" . $row['club_name'] . "&begin=" . $row['club_begin'] . "' style='text-decoration:none;color:white;'><div class='card-header'>" . $row['club_begin'] . "</div>
  <div class='card-body'>
    <h5 class='card-title'>" . $row['club_name'] . "</h5>
    <p class='card-text'>" . $row['club_description'] . "</p>
  </div></div></a>";
                }
            } else {
                echo "<h5 style='color:red;padding-top:100px;''>No matching result!</h5>";
            }
        } else {
            echo "<h5 style='color:red;padding-top:100px;''>Please write something in the search box!</h5>";
        }
    } else if (isset($_GET['error'])) {
        if ($_GET['error'] == 'all') {
            $value = mysqli_real_escape_string($conn, '');
            $sql = "SELECT * FROM CLUB WHERE club_name LIKE '%$value%' OR club_description LIKE '%$value%' OR
                    club_begin LIKE '%$value%' OR club_contact LIKE '%$value%'";
            $result = mysqli_query($conn, $sql);
            $nore = mysqli_num_rows($result);

            if ($nore > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='card mb-3' style='max-width: 18rem;color:white;background-color:#202945'>
  <a href='result.php?name=" . $row['club_name'] . "&begin=" . $row['club_begin'] . "' style='text-decoration:none;color:white;'><div class='card-header'>" . $row['club_begin'] . "</div>
  <div class='card-body'>
    <h5 class='card-title'>" . $row['club_name'] . "</h5>
    <p class='card-text'>" . $row['club_description'] . "</p>
  </div></div></a>";
                }
            }
        }
    } else {
        echo "<h5 style='color:red;padding-top:100px;''>Aren't you a smartie:)</h5>";
    }

    ?>
</section>
<?php

include_once 'footer.php';

?>