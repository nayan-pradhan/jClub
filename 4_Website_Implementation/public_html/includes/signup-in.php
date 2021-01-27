<?php

if (isset($_POST["button"])) {
    
    $name = $_POST["studentname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $pass = $_POST["pwd"];
    $passRe = $_POST["repwd"];
    $major = $_POST["major"];
    $accountdes = $_POST["accountdes"];
    $dateofbirth = $_POST["dob"];

    require_once 'dbh-in.php';
    require_once 'function-in.php';

    //functions to handle errors 
    if (invaliduserid($username) !== false) {
        header("location: ../signlog.php?error=invaliduid");
        exit();
    }

    if (invalidemail($email) !== false) {
        header("location: ../signlog.php?error=invalidemail");
        exit();
    }

    if (passmatch($pass,$passRe) !== false) {
        header("location: ../signlog.php?error=passmatch");
        exit();
    }

    if (uidex($conn, $username, $email) !== false) {
        header("location: ../signlog.php?error=usertaken");
        exit();
    }

    insertuser($conn, $name, $email, $username, $pass, $major, $accountdes, $dateofbirth);

} else {
    header("location: ../signlog.php");
    exit();
}