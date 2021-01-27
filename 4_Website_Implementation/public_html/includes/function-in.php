<?php

function invaliduserid($username) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}



function invalidemail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function passmatch($pass, $passRe) {
    $result;
    if ($pass != $passRe) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}


//checking if username exists in database or not
function uidex($conn, $username, $email)
{
    $sql  = "SELECT * FROM ACCOUNTS WHERE account_Username = ? OR account_email = ?;";
    $prestate = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($prestate, $sql)) {
        header("location: ../signlog.php?error=prestatefailed");
        exit();
    }

    mysqli_stmt_bind_param($prestate, "ss", $username, $email);
    mysqli_stmt_execute($prestate);


    $resultdata = mysqli_stmt_get_result($prestate);

    if ($row = mysqli_fetch_assoc($resultdata)) {
        mysqli_stmt_close($prestate);
        return $row;
    } else {
        mysqli_stmt_close($prestate);
        $result = false;
        return $result;
    }

}

//inserting data into database for user/student
function insertuser($conn, $name, $email, $username, $pass, $major, $accountdes, $dateofbirth) {
    $sql1  = "INSERT INTO ACCOUNTS(account_Username, account_Password, account_Type, account_des, account_email) VALUES (?,?,?,?,?);";
    $sql2 = "INSERT INTO STUDENT(student_name, student_DOB, student_major, student_contact) VALUES(?,?,?,?);";
    $prestate1 = mysqli_stmt_init($conn);
    $prestate2 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($prestate1, $sql1)) {
        header("location: ../signlog.php?error=prestatefailed");
        exit();
    }

    $hashing = password_hash($pass, PASSWORD_DEFAULT);

    if (!mysqli_stmt_prepare($prestate2, $sql2)) {
        header("location: ../signlog.php?error=prestatefailed");
        exit();
    }

    $user = "user";
    //prepared statement 1 
    //inserting into ACCOUNTS table
    mysqli_stmt_bind_param($prestate1, "sssss", $username, $hashing, $user, $accountdes , $email);
    mysqli_stmt_execute($prestate1);
    $accid = mysqli_insert_id($conn);
    mysqli_stmt_close($prestate1);
    //prepared statement 2
    //inserting into STUDENT table
    mysqli_stmt_bind_param($prestate2, "ssss", $name, $dateofbirth, $major, $email);
    mysqli_stmt_execute($prestate2);
    $studid = mysqli_insert_id($conn);
    mysqli_stmt_close($prestate2);

    //inserting into MANAGES table
    //prepared statement 3
    $sql3 = "INSERT INTO MANAGES(account_id, student_id) VALUES(?,?);";
    $prestate3 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($prestate3, $sql3)) {
        header("location: ../signlog.php?error=prestatefailed");
        exit();
    }
    mysqli_stmt_bind_param($prestate3, "ii", $accid, $studid);
    mysqli_stmt_execute($prestate3);
    mysqli_stmt_close($prestate3);

    //inserting into Permission table
    //prepared statement 4
    $sql4 = "INSERT INTO PERMISSION(permission_name) VALUES(?);";
    $prestate4 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($prestate4, $sql4)) {
        header("location: ../signlog.php?error=prestatefailed1");
        exit();
    }
    mysqli_stmt_bind_param($prestate4, "s", $user);
    mysqli_stmt_execute($prestate4);
    $permid = mysqli_insert_id($conn);
    mysqli_stmt_close($prestate4);

    //inserting into Holds table
    //prepared statement 5
    $sql5 = "INSERT INTO HOLDS(account_id, permission_id) VALUES(?,?);";
    $prestate5 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($prestate5, $sql5)) {
        header("location: ../signlog.php?error=prestatefailed2");
        exit();
    }
    mysqli_stmt_bind_param($prestate5, "ii", $accid, $permid);
    mysqli_stmt_execute($prestate5);
    mysqli_stmt_close($prestate5);



    header("location: ../signlog.php?error=none");
    exit();
    
}

function login($conn, $username, $pass) {
    $uidex = uidex($conn, $username, $username);


    if ($uidex == false) {
        header("location: ../signlog.php?error=wronguserorpass");
        exit();
    }

    $hashedPass = $uidex['account_Password'];
    $checkpass = password_verify($pass,$hashedPass);

    if ($checkpass === false) {
        header("location: ../signlog.php?error=wronguserorpass");
        exit();
    }
    else if ($checkpass === true) {
        session_start();
        $_SESSION["accid"] = $uidex['account_id'];
        $_SESSION["accusername"] = $uidex['account_Username'];
        header("location: ../index.php");
        exit();
    }
}