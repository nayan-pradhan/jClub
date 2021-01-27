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
            <?php require 'includes/server-script-student-in.php' ?>
            <form action="studentsearchpage.php" method="post">
                <h3>Search for students</h3>
                <div class="p-1 bg-warning rounded rounded-pill shadow-sm mb-4">
                    <div class="input-group">
                        <input type="search" id="autocomplete" name="searchwordstu" placeholder="Search for students..." aria-describedby="button-addon1" class="form-control border-0 bg-light">
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

<!-- Footer -->
<footer id="footer">
    <div id="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 text-center">
                    <img src="Logo/logowhitetrans.png" width="200">
                    <p class="footer-text">Copyright &copy;2020<br>All rights reserved
                        <div class="credits">
                            Made with <i class="fa fa-heart" style="color: orangered;"></i> by Arnav, Ankit
                            and Nayan
                    </p>
                    <i class="fab fa-facebook fa-lg"></i>
                    <i class="fab fa-instagram fa-lg"></i>
                    <i class="fab fa-twitter fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
    </div>
</footer>
<script type="text/javascript">
    $(document).ready(function() {
        $("#autocomplete").keyup(function() {
            var query = $("#autocomplete").val();
            console.log(query);
            $.ajax({
                url: 'includes/server-script-student-in.php',
                method: 'POST',
                data: {
                    q: query
                },
                dataType: 'text'
            });
        });
    });
</script>

<script>
    var tags = <?php echo json_encode($stack); ?>;
    $("#autocomplete").autocomplete({
        source: function(request, response) {
            var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(tags, function(item) {
                return matcher.test(item);
            }));
        }
    });
</script>

<?php exit() ?>

</body>

</html>