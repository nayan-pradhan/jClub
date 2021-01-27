<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'includes/dbh-in.php';
require_once 'includes/function-in.php';
$clid = $_SESSION["clubid"];

$clubidres = getactinfo1($conn, $clid);

while ($row = mysqli_fetch_assoc($clubidres)) {
    $sql  = "SELECT * FROM ACTIVITY WHERE activity_id = ?;";
    $prestate = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($prestate, $sql)) {
        header("location: ../index.php?error=prestatefailed");
        exit();
    }

    mysqli_stmt_bind_param($prestate, "i", $row['activity_id']);
    mysqli_stmt_execute($prestate);

    $resultdata = mysqli_stmt_get_result($prestate);

    $actin = mysqli_fetch_assoc($resultdata);

    echo "<li>". $actin['activity_name'] . ":</li>";
    echo "<ul><li>Location: " . $actin['activity_location'] . "</li>";
    echo "<li>Desciption: " . $actin['activity_desc'] . "</li>";
    echo "<li>Type: " . $actin['activity_type'] . "</li>";
    echo "<li>Day: " . $actin['activity_day'] . "</li>";
    echo "<li>Time: " . $actin['activity_time'] . "</li></ul>";
    exit();
}