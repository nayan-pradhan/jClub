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

    if (isset($_POST['searchstu'])) {
        if ($_POST['searchwordstu'] != NULL) {
            $value = mysqli_real_escape_string($conn, strip_tags($_POST['searchwordstu']));
            $sql = "SELECT * FROM STUDENT WHERE student_name LIKE '%$value%' OR student_major LIKE '%$value%';";
            $result = mysqli_query($conn, $sql);
            $nore = mysqli_num_rows($result);

            if ($nore > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='card mb-3' style='max-width: 18rem;color:white;background-color:#202945'>
  <a href='studentresult.php?name=" . $row['student_name'] . "&begin=" . $row['student_DOB'] . "' style='text-decoration:none;color:white;'><div class='card-header'>" . $row['student_DOB'] . "</div>
  <div class='card-body'>
    <h5 class='card-title'>" . $row['student_name'] . "</h5></div></div></a>";
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
            $sql = "SELECT * FROM STUDENT WHERE student_name LIKE '%$value%' OR student_DOB LIKE '%$value%' OR
                    student_major LIKE '%$value%' OR student_contact LIKE '%$value%';";
            $result = mysqli_query($conn, $sql);
            $nore = mysqli_num_rows($result);

            if ($nore > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='card mb-3' style='max-width: 18rem;color:white;background-color:#202945'>
  <a href='studentresult.php?name=" . $row['student_name'] . "&begin=" . $row['student_DOB'] . "' style='text-decoration:none;color:white;'><div class='card-header'>" . $row['student_DOB'] . "</div>
  <div class='card-body'>
    <h5 class='card-title'>" . $row['student_name'] . "</h5></div></div></a>";
                }
            }
        } else {
            echo "<h5 style='color:red;padding-top:100px;'>No students yet!</h5>";
        }
    } else {
        echo "<h5 style='color:red;padding-top:100px;'>Aren't you a smartie:)</h5>";
    }

    ?>
</section>
<?php

include_once 'footer.php';

?>