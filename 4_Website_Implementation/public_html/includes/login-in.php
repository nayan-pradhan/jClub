<?php

if (isset($_POST['buton'])) {

    $username = $_POST["userid"];
    $pass = $_POST["password"];

    require_once 'dbh-in.php';
    require_once 'function-in.php';

    login($conn, $username, $pass);

}
else {
    header("location: ../signlog.php?error=emptyfields");
    exit();
}