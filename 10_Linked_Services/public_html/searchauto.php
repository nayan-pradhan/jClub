    <?php
    session_start();
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>jClub</title>
        <?php
        if (isset($_SESSION["accid"])) {
            if ($_SESSION["acctype"] == "club") {
                echo "<link rel='stylesheet' type='text/css' href='css/c.css'>";
            } else {
                echo "<link rel='stylesheet' type='text/css' href='css/styles.css'>";
            }
        } else {
            echo "<link rel='stylesheet' type='text/css' href='css/styles.css'>";
        }
        ?>

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

        <!-- Jquery link -->
        <script type="javascript" src="./main.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <link rel="stylesheet" href="css/jquerybox.css">

        <?php

        include_once 'nav.php';

        ?>

        <!--Search Bar-->
        <div class="row" style="margin-top:150px;">
            <div class="col-sm-5 mx-auto">
                <?php require 'includes/server_script_search_club-in.php' ?>
                <form action="searchpage.php" method="post">
                    <div class="p-1 bg-warning rounded rounded-pill shadow-sm mb-4">
                        <div class="input-group">
                            <input type="search" name="searchword" id="autocomplete" placeholder="Which club are you searching for?" aria-describedby="button-addon1" class="form-control border-0 bg-light">
                            <div class="input-group-append">
                                <button id="button-addon1" type="submit" name="search" class="btn btn-link text-primary"><i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

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
                        url: 'includes/server_script_search_club-in.php',
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