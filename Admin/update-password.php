<?php include('parts/menu.php'); ?>
<link rel="stylesheet" href="1.css">
<div class="main-content">
    <h1>Update Password</h1>
    <?php
        if(isset($_GET['id'])) 
        {
            $id = $_GET['id'];
        }
    ?>
    <div class="form">
        <form action="" method="POST">
            <table>
                <tr>
                    <td>Current Password</td>
                    <td>
                        <input type="password" name="current_password">
                    </td>
                </tr>

                <tr>
                    <td>New password</td>
                    <td>
                        <input type="password" name="new_password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password">
                    </td>
                </tr>

                <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="submit" name="submit" value="Change Password" class="update-btn">
                </td>
            </table>
        </form>
    </div>
</div>
<?php
    if(isset($_POST['submit']))
    {
        // Check if 'id' is set in the form submission
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $current_password=$_POST['current_password'];
        $new_password=$_POST['new_password'];
        $confirm_password=$_POST['confirm_password'];

        $sql="SELECT * FROM Admin_table WHERE id=$id AND password='$current_password'";


        $res=mysqli_query($conn,$sql);
        if($res==true)
        {
            $count=mysqli_num_rows($res);
            if($count==1)
            {
                if($new_password==$confirm_password)
                {
                    $sql1="UPDATE Admin_table set
                    password='$new_password'
                    where id=$id
                    ";

                    $res1=mysqli_query($conn,$sql1);
                    if($res1==true)
                    {
                        $_SESSION['password updated']="password updated succesfully";
                        header("location:".SITEURL.'Admin/manage-admin.php');
                    }
                    else
                    {
                        $_SESSION['password updated']="error in changing password please try again";
                        header("location:".SITEURL.'Admin/manage-admin.php');
                    }
                }
                else
                {
                    $_SESSION['password not matched']="password is not matched! please try again";
                    header("location:".SITEURL.'Admin/manage-admin.php');
                }
            }

        }
        else
        {
            $_SESSION['no user found']="no admin found";
            header("location:".SITEURL.'Admin/manage-admin.php');
        }
    }
?>


<?php include('parts/footer.php'); ?>
