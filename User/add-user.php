
<?php include('../front-parts/home.php');?>
<link rel="stylesheet" href="1.css">

</style>
<div class="main-content">
    <h1>Add User</h1>
    <br>
    <?php
        if(isset($_SESSION['add-user']))
        {
            echo $_SESSION['add-user'];
            unset($_SESSION['add-user']);
        }
    ?>
    <div class="form">
        <form action="" method="POST">
            <table width=30%>
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" placeholder="Enter username">
                    </td>
                </tr>
                <tr>
                    <td>Full name</td>
                    <td><input type="text" name="Full_name" placeholder="Enter your name"></td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" placeholder="Enter email"></td>
                </tr>

                <tr>
                    <td>Phone</td>
                    <td><input type="tel" name="phone" placeholder="Enter Phone number"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter a strong password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="submit" name="submit" value="Signup" class="update-btn">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>


<?php
    if(isset($_POST['submit']))
    {
        $username=$_POST['username'];
        $full_name=$_POST['Full_name'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $password=$_POST['password'];

        // Check if the username already exists in the database
        $check_sql = "SELECT * FROM user_table WHERE username='$username'";
        $check_result = mysqli_query($conn, $check_sql);

        if(mysqli_num_rows($check_result) > 0) 
        {
            // Username already exists, show error message
            $_SESSION['add-user'] = 'Username already exists. Please choose a different username.';
            header("location:".SITEURL.'User/add-user.php');
        } 
        else 
        {
            // Username is unique, proceed with insertion
            $sql="INSERT INTO user_table SET
                username='$username',
                full_name='$full_name',
                email='$email',
                phone='$phone',
                password='$password'
            ";

            $res = mysqli_query($conn, $sql);

            if($res==true)
            {
                $_SESSION['add-user']='User Added successfully. You can now login.';
                header("location:".SITEURL.'User/user-login.php');
            }
            else
            {
                $_SESSION['add-user']='Error in adding user. Please try again.';
                header("location:".SITEURL.'User/add-user.php');
            }
        }
    }
?>