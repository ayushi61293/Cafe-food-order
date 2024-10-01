<?php include('../cons/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        *{
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .login {
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
            width: 30%;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .login h1 {
            margin-bottom: 20px;
            color: #333;
        }
        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
        }
        .login-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 3px;
            background-color: rgb(56, 153, 56);
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .login-form input[type="submit"]:hover {
            background-color: #3c9d3c;
        }
        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login">
        <h1>Login</h1>
        <?php
            if(isset($_SESSION['login-failed'])) {
                echo '<div class="error-message">' . $_SESSION['login-failed'] . '</div>';
                unset($_SESSION['login-failed']);
            }
            if(isset($_SESSION['login-first-message'])) {
                echo '<div class="error-message">' . $_SESSION['login-first-message'] . '</div>';
                unset($_SESSION['login-first-message']);
            }
        ?>
        <form class="login-form" action="" method="POST">
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" placeholder="Enter your username"><br><br>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" placeholder="Enter your password"><br><br>
            <input type="submit" name="submit" value="Login">
        </form>
    </div>
</body>
</html>
<?php
    if(isset($_POST['submit'])) {
        $username=$_POST['username'];
        $password=$_POST['password'];

        $sql="SELECT * FROM Admin_table WHERE username='$username' AND password='$password'";

        $res=mysqli_query($conn,$sql);

        if($res==true) {
            $count=mysqli_num_rows($res);
            if($count==1) {
                $_SESSION['admin-login']="Login Successfull";
                $_SESSION['user']="$username";
                header("location:".SITEURL.'admin/manage-admin.php');
            } else {
                $_SESSION['login-failed']="Failed to login please enter correct username or password";
                header("location:".SITEURL.'admin-login.php');
            }
        }
    }
?>
