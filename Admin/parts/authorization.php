<?php
//to chech whether the user is logged in or not
    if(!isset($_SESSION['user']))
    {
        //go to login page with message
        $_SESSION['login-first-message']="Login first to get access";
        header("location:".SITEURL.'Admin/admin-login.php');
    }
?>