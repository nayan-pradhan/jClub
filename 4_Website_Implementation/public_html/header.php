<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jClub</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel='icon' href="icon/favicon.ico">
    <!-- Fonts Link -->
    <link href="https://fonts.googleapis.com/css?family=Kelly+Slab|Titillium+Web&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Asap:700|Roboto&display=swap" rel="stylesheet">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Fonawesome -->
    <script src="https://kit.fontawesome.com/7594947089.js" crossorigin="anonymous"></script>

    <!-- Icon link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="Scripts/bootstrap.min.js"></script>

    <!-- Javascript link -->
    <script type="javascript" src="./main.js"></script>
    <!-- <script type="javascript" src="./particles.js"></script> -->
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark" style="background-color: #202945;">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item menu active">
                    <!--Side navigation bar-->
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <a href="#">About</a>
                        <a href="#">Services</a>
                        <a href="#">Clients</a>
                        <a href="#">Contact</a>
                    </div>
                    <span style="color:white;font-size:medium;cursor:pointer;" onclick="openNav()">&#9776;
                        Menu</span>

                    <script>
                        function openNav() {
                            document.getElementById("mySidenav").style.width = "175px";
                        }

                        function closeNav() {
                            document.getElementById("mySidenav").style.width = "0";
                        }
                    </script>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://www.jacobs-university.de/life-work/campus-life" title="Jacobs University Official Clubs Page" target="_blank">Clubs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="imprintPage.html">Imprint Page</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Services
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Start a club</a>
                        <a class="dropdown-item" href="#">Register for a Club</a>
                        <a class="dropdown-item" href="#">Contact Us</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="mx-auto order-0">
            <a class="navbar-brand mx-auto" href="#">jClub</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <?php
                if (isset($_SESSION["accid"])) {
                    echo "<li class='nav-item'><p style='color:white;font-size:15px;padding-top:13px;margin-bottom:0;'>Welcome, " . $_SESSION['accusername'] . "</p></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='includes/logout-in.php'><button type='button' class='btn btn-outline-danger btn-sm'>Logout</button></a></li>";
                } else {
                    echo "<li class='nav-item'><a class='nav-link' href='signlog.php'><button type='button' class='btn btn-outline-warning btn-sm' action=''>Login</button></a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='signlog.php'><button type='button' class='btn btn-outline-success btn-sm'>Sign Up</button></a>";
                }
                ?>
                </li>
            </ul>
        </div>
    </nav>
    </section>
    <!-- End of Navbar -->