<link rel="stylesheet" href="1.css">
<?php include('parts/menu.php'); ?>


<div class="manage-admin">
    
    <h1>Manage Admin</h1>
    <br>
    <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['Update']))
        {
            echo $_SESSION['Update'];
            unset($_SESSION['Update']);
        }
        if(isset($_SESSION['password updated']))
        {
            echo $_SESSION['password updated'];
            unset($_SESSION['password updated']);
        }
        if(isset($_SESSION['password not matched']))
        {
            echo $_SESSION['password not matched'];
            unset($_SESSION['password not matched']);
        }
        if(isset($_SESSION['no user found']))
        {
            echo $_SESSION['no user found'];
            unset($_SESSION['no user found']);
        }
        if(isset($_SESSION['admin-login']))
        {
            echo $_SESSION['admin-login'];
            unset($_SESSION['admin-login']);
        }
    ?>
    <br>
    <br>
    <a href="add-admin.php" class="primarybtn">Add Admin</a>
    <br>
    <br>
    <table class="tbl">
        <tr>
            <th>Sno.</th>
            <th>Username</th>
            <th>Full name</th>
            <th>Actions</th>
        </tr>

        <?php
        //selecting the query
            $sql="SELECT * from admin_table" ;
        //execute the query
            $res=mysqli_query($conn,$sql);

            if($res==true)
            {
                //counting the number of rows to chek whether there is data in our table or not
                $count=mysqli_num_rows($res);
                $num=1;

                if($count>0)
                {
                    //we have data in our database
                    //using while to get data from database
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        $id=$rows['id'];
                        $username=$rows['username'];
                        $full_name=$rows['full_name'];

                        ?>
                            <tr>
                                <td><?php echo $num++ ?>.</td>
                                <td><?php echo $username ?></td>
                                <td><?php echo $full_name ?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>Admin/update-password.php?id=<?php echo $id?>" class="primarybtn">Update Password</a>
                                    <a href="<?php echo SITEURL;?>Admin/update-admin.php?id=<?php echo $id?>" class="update-btn">Update Admin</a>
                                    <a href="<?php echo SITEURL;?>Admin/delete-admin.php?id=<?php echo $id?>" class="delete-btn">Delete Admin</a>
                                </td>
                            </tr>
                            <?php
                    }
                }
                else
                {
                    //no data is present
                }
            }
            ?>

    </table>
</div>
<?php include('parts/footer.php'); ?>