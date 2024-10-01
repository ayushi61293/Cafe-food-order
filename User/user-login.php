<?php include('../front-parts/home.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}

.login {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    padding: 40px;
    max-width: 400px;
    margin: 0 auto;
}

.login h1 {
    color: #333;
    font-size: 24px;
    margin-bottom: 30px;
    text-align: center;
}

.login input[type="text"],
.login input[type="password"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: none;
    border-radius: 5px;
    background-color: #f7f7f7;
}

.login input[type="submit"] {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

.login input[type="submit"]:hover {
    background-color: #45a049;
}

.login a {
    display: block;
    text-align: center;
    text-decoration: none;
    color: #333;
    font-size: 14px;
    margin-top: 20px;
}

.login a:hover {
    color: #555;
}

    </style>
</head>
<body>
    <div class="login">
        <h1>Login</h1>
        <br>
        <br>
        <?php
            if(isset($_SESSION['failed-to-login'])) {
                echo $_SESSION['failed-to-login'];
                unset($_SESSION['failed-to-login']);
            }
            if(isset($_SESSION['login-first'])) {
                echo $_SESSION['login-first'];
                unset($_SESSION['login-first']);
            }
            if(isset($_SESSION['add-user'])) {
                echo $_SESSION['add-user'];
                unset($_SESSION['add-user']);
            }
        ?>
        <br>
            <br>
            <br>
            
        <form action="" method="POST">
            Username<br>
            <input type="text" name="username" placeholder="Enter your username"><br><br>
            Password<br>
            <input type="password" name="password" placeholder="Enter your password"><br><br>
            <input type="submit" name="submit" value="Log in" class="login-btn">
            <a href="add-user.php">Sign Up</a> <!-- Added Sign Up link -->
        </form>

    </div>
</body>
</html>
<?php
    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user_table WHERE username='$username' AND password='$password'";
        $res = mysqli_query($conn, $sql);

        if($res == true) {
            $count = mysqli_num_rows($res);
            if($count == 1) {
                $_SESSION['user-login'] = "Login Successfull";
                $_SESSION['user1'] = $username;
                header("location: " . SITEURL . 'index.php');
            } else {
                $_SESSION['failed-to-login'] = "Failed to login. Please enter correct username or password.";
                header("location: " . SITEURL . 'User/user-login.php');
            }
        }
    }
?>
