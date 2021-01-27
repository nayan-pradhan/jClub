<?php
include_once 'head.php';
?>

<link rel="stylesheet" href="css/studsearch.css">

<?php

include_once 'nav.php';

?>


<section id="LandingPage" class="demo">
    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'execfail') {
            echo "<h4>Fatal Error!</h5>";
            exit();
        }
    }
    ?>
    <!--Search Bar-->
    <div class="row">
        <div class="col-sm-5 mx-auto">
            <form action="studentsearchpage.php" method="post">
                <h3>Search for students</h3>
                <div class="p-1 bg-warning rounded rounded-pill shadow-sm mb-4">
                    <div class="input-group">
                        <input type="search" name="searchwordstu" placeholder="Search for students" aria-describedby="button-addon1" class="form-control border-0 bg-light">
                        <div class="input-group-append">
                            <button id="button-addon1" type="submit" name="searchstu" class="btn btn-link text-primary"><i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php
include_once 'footer.php';

?>