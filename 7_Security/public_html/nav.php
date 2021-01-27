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
                        <a href="imprintPage.html">Imprint</a>
                        <a href="#">Contact</a>
                    </div>
                    <span style="color:white;font-size:medium;cursor:pointer;" onclick="openNav()">&#9776;
                        Menu</span>

                    <script>
                        function openNav() {
                            document.getElementById("mySidenav").style.width = "200px";
                        }

                        function closeNav() {
                            document.getElementById("mySidenav").style.width = "0";
                        }
                    </script>
                </li>
                <?php
                if (isset($_SESSION['acctype'])) {
                    if ($_SESSION['acctype'] == 'user') {
                        echo "<li class='nav-item'><a class='nav-link' href='studentresult.php'>My profile</a></li>";
                        echo "<li class='nav-item'><a class='nav-link' href='register.php'>Register</a></li>";
                    }
                    if ($_SESSION['acctype'] == 'admin') {
                        echo "<li class='nav-item'><a class='nav-link' href='maintainence.php'>Maintainence</a></li>";
                        echo "<li class='nav-item'><a class='nav-link' href='searchstudents.php'>Student Search</a></li>";
                    }
                    if ($_SESSION['acctype'] == 'club') {
                        echo "<li class='nav-item'><a class='nav-link' href='searchstudents.php'>Student Search</a></li>";
                    }
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="searchpage.php?error=all">Clubs</a>
                </li>
            </ul>
        </div>
        <div class="mx-auto order-0">
            <a class="navbar-brand mx-auto" href="index.php">
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 'exec') {
                        echo "<h5 style='color:red;padding-top:1.5px;margin-bottom:0;'>jClub</h5>";
                    } else if ($_GET['error'] == 'none') {
                        echo "<h5 style='color:green;padding-top:1.5px;margin-bottom:0;'>jClub</h5>";
                    } else {
                        echo "jClub";
                    }
                } else {
                    echo "jClub";
                }
                ?>

            </a>
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
                    echo "<li class='nav-item'><a class='nav-link' href='createclub.php'><button type='button' class='btn btn-outline-warning btn-sm' action=''>Create a Club</button></a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='signlog.php'><button type='button' class='btn btn-outline-success btn-sm'>Login/SignUp</button></a>";
                }
                ?>
                </li>
            </ul>
        </div>
    </nav>
    </section>
    <!-- End of Navbar -->