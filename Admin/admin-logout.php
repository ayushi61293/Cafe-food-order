<?php
    include('../cons/constants.php');
    session_destroy();

    header("location:".SITEURL.'index.php');

?>
