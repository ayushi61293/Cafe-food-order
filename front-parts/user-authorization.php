<?php
//to chech whether the user is logged in or not
    if(!isset($_SESSION['user1']))
    {
        //go to login page with message
        $_SESSION['login-first']="Login first to get access";
        header("location:".SITEURL.'User/user-login.php');
    }
?>