<?php include('parts/menu.php');?>
<link rel="stylesheet" href="1.css">
</style>
<div class="main-content">
    <h1>Manage food</h1>
    <br>
    <a href="<?php echo SITEURL;?>Admin/add-food.php" class="primarybtn">Add Food</a>
    <br>
    <br>
    <?php
        if(isset($_SESSION['add food']))
        {
            echo $_SESSION['add food'];
            unset($_SESSION['add food']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['failed to remove image']))
        {
            echo $_SESSION['failed to remove image'];
            unset($_SESSION['failed to remove image']);
        }
        if(isset($_SESSION['update food']))
        {
            echo $_SESSION['update food'];
            unset($_SESSION['update food']);
        }
        if(isset( $_SESSION['upload-image']))
        {
            echo  $_SESSION['upload-image'];
            unset( $_SESSION['upload-image']);
        }
    ?>
    <table class="tbl">
        <tr>
            <th>Sno.</th>
            <th>Title</th>
            <th>Image name</th>
            <th>Price</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
        <?php
            $sql="SELECT * FROM food_table";
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            if($count>0)
            {
                $sn=1;
                while($row=mysqli_fetch_assoc($res))
                {
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    $price=$row['price'];
                    $featured=$row['featured'];
                    $active=$row['active'];

                    ?>
                        <tr>
                            <td><?php echo $sn++ ?>.</td>
                            <td><?php echo $title ;?></td>
                            <td>
                            <?php
                                if($image_name!="")
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>photos/food/<?php echo $image_name;?>" width="100px" >

                                    <?php
                                }
                                else
                                {
                                    echo "Image not added";
                                }
                            ?>
                            </td>
                            <td><?php echo $price ?></td>
                            <td><?php echo $featured ;?></td>
                            <td><?php echo $active ;?></td>
                            <td>
                                <a href="<?php echo SITEURL;?>Admin/update-food.php?id=<?php echo $id; ?>" class="update-btn">Update food</a>
                                <a href="<?php echo SITEURL;?>Admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="delete-btn">Delete Food</a>
                            </td>
                        </tr>
                    <?php
                }
            }
            else
            {
                ?>
                 <tr>
                    <td colspan="7"><div>No food added</div></td>
                </tr>
                <?php

            }
        ?>
    </table>
</div>
<?php include('parts/footer.php');?>
