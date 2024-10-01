<?php include('parts/menu.php'); ?>
<link rel="stylesheet" href="1.css">
    <div class="main-content">
        <h1>Update Admin</h1>
        <?php
            $id=$_GET['id'];

            $sql="SELECT * FROM Admin_table WHERE id=$id";

            $res=mysqli_query($conn,$sql);

            if($res==true)
            {
                $count=mysqli_num_rows($res);
                if($count==1)
                {
                    $rows=mysqli_fetch_assoc($res);
                    $username=$rows['username'];
                    $full_name=$rows['full_name'];
                }
                else
                {
                    header("location:".SITEURL.'Admin/manage-admin.php');
                }
            }
        ?>
        <div class="form">
            <form action="" method="POST">
                <table>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username" value="<?php echo $username?>"></td>
                    </tr>

                    <tr>
                        <td>Full name</td>
                        <td><input type="text" name="full_name" value="<?php echo $full_name?>"></td>
                    </tr>

                    <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="submit" name="submit" value="Update Admin" class="update-btn">
                    </td>
                </tr>
                </table>
            </form>
        </div>
    </div>

<?php
        if(isset($_POST['submit']))
        {
            //get all the values from form
            $username=$_POST['username'];
            $full_name=$_POST['full_name'];
            $id=$_POST['id'];
            
            //query to update values

            $sql="UPDATE Admin_table SET 
            username='$username',
            full_name='$full_name'
            WHERE id=$id
            ";
            //executing the query
            $res=mysqli_query($conn,$sql);
            if($res==true)
            {
                $_SESSION['Update']="Admin Updated succesfully";
                header("location:".SITEURL.'Admin/manage-admin.php');
            }
            else
            {
                $_SESSION['Update']="Failed to update Admin please try again";
                header("location:".SITEURL.'Admin/manage-admin.php');
                
            }

        }
?>


<?php include('parts/footer.php'); ?>