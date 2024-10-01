<?php include("parts/menu.php");?>
<link rel="stylesheet" href="1.css">

</style>
<div class="main-content">
    <h1>Add Admin</h1>
    <br>
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
                    <td>Enter password</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter a strong password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="update-btn">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>


<?php include("parts/footer.php");?>
<?php
//to check whether the data is came from the form
    if(isset($_POST['submit']))
    {
        //to get data from the form
         $username=$_POST['username'];
         $full_name=$_POST['Full_name'];
         $password=$_POST['password'];

         //to insert data into our database
        $sql="INSERT INTO admin_table SET
            username='$username',
            full_name='$full_name',
            password='$password'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['add']='Admin Added succesfully';
            header("location:".SITEURL.'Admin/manage-admin.php');
        }
        else
        {
            $_SESSION['add']='Error in adding admin please try again';
            header("location:".SITEURL.'Admin/add-admin.php');
        }
    }
?>