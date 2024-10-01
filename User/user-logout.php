<?php
    include('../front-parts/home.php');
    session_destroy();

    header("location:".SITEURL.'User/user-login.php');

?>