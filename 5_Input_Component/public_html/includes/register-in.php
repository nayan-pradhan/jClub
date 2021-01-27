<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST["reg"])) {

    $accid = $_SESSION['accid'];

    require_once 'dbh-in.php';
    require_once 'function-in.php';

    $clubid = intval(mysqli_real_escape_string($conn, strip_tags($_POST["opt"])));

    $stu=insertreg($conn, $accid);

    $sql5 = "INSERT INTO REGISTER(date_joined,student_id, club_id) VALUES(?,?,?);";
    $prestate5 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($prestate5, $sql5)) {
        header("location: ../register.php?error=prestatefailed");
        exit();
    }
    $today = "2020-02-01";
    mysqli_stmt_bind_param($prestate5, "sii", $today ,$stu, $clubid);
    if (!mysqli_stmt_execute($prestate5)) {
        header("location: ../register.php?error=exec" . "&" . $clubid);
        exit();
    }
    mysqli_stmt_close($prestate5);

    header("location: ../register.php?error=success");
    exit();

} else {
    header("location: ../index.html?error=noselection");
    exit();
}