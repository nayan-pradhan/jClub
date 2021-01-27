<?php

include_once 'header.php';

?>

<form class="register-group" action="includes/register-in.php" method="post" style="padding:5%;padding-bottom:0;">
    <label for="club_categories" class="label_text">Category of Club: </label><br>
    <select id="club_categories" class="input-field" name="opt" required>
        <?php
        require_once 'includes/getallclub.php'
        ?>
    </select>
    <button type="submit" class="btn btn-outline-warning submit-btn btn-sm" name="reg">Register</button>
</form>
<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'success') {
        echo "<p style='text-align:center; padding: 15px; color:green;font-size:13px;'>Successfully registered.</p>";
    } else if ($_GET['error'] == 'prestatefailed') {
        echo "<p style='text-align:center; padding: 15px; color:red;font-size:13px;'>Oops! Something is not right!</p>";
    } else if ($_GET['error'] == 'exec') {
        echo "<p style='text-align:center; padding: 15px; color:red;font-size:13px;'>Exec Failed!</p>";
    }
}
?>

<?php

include_once 'footer.php';

?>