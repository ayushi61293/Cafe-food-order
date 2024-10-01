<?php
    session_start();
    define('SITEURL', 'http://localhost/Food%20Order%20Website/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','online food order');

    $conn=mysqli_connect(LOCALHOST,DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //to make a connection where default username is root and pasword is blank
    $db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); // to select database
?>