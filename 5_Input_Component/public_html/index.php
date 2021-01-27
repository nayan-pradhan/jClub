<?php

include_once 'header.php';

?>

<?php
if (isset($_SESSION["accid"])) {
    if ($_SESSION["acctype"] == "club") {
        require_once 'content2.php';
    } else {
        require_once 'content1.php';
    }
} else {
    require_once 'content1.php';
}
?>

<?php

include_once 'footer.php';

?>