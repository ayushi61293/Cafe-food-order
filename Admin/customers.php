<?php include('parts/menu.php'); ?>
<link rel="stylesheet" href="1.css">
    <table class="tbl">
    <tr>
        <th>Sno.</th>
        <th>Username</th>
        <th>Full name</th>
        <th>Email</th>
        <th>Phone no.</th>
        <th>Actions</th>
    </tr>

    <?php
    //selecting the query
        $sql="SELECT * from user_table" ;
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
                    $email=$rows['email'];
                    $phone=$rows['phone'];

                    ?>
                        <tr>
                            <td><?php echo $num++ ?>.</td>
                            <td><?php echo $username ?></td>
                            <td><?php echo $full_name ?></td>
                            <td><?php echo $email ?></td>
                            <td><?php echo $phone ?></td>
                            <td>
                                <a href="<?php echo SITEURL;?>Admin/delete-admin.php?id=<?php echo $id?>" class="delete-btn">Delete User</a>
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
