<?php 
    include('parts/menu.php');
?>
<link rel="stylesheet" href="1.css">
<div class="main-content">
    <h1>Manage Category</h1>
    <br>
    <a href="<?php echo SITEURL;?>Admin/add-category.php" class="primarybtn">Add Category</a>
    <br>
    <br>
    <?php
        if(isset($_SESSION['add category']))
        {
            echo $_SESSION['add category'];
            unset($_SESSION['add category']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if(isset($_SESSION['no category']))
        {
            echo $_SESSION['no category'];
            unset($_SESSION['no category']);
        }
        if(isset($_SESSION['update category']))
        {
            echo $_SESSION['update category'];
            unset($_SESSION['update category']);
        }
        if(isset($_SESSION['removal-failure']))
        {
            echo $_SESSION['removal-failure'];
            unset($_SESSION['removal-failure']);
        }
    ?>
    <table class="tbl">
        <tr>
            <th>Sno.</th>
            <th>Title</th>
            <th>Image name</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
        <?php
            $sql = "SELECT * FROM category_table";
            $res = mysqli_query($conn, $sql);
            if($res == true)
            {
                $count = mysqli_num_rows($res);
                $num=1;
                if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    ?>
                    <tr>
                        <td><?php echo $num++;?>.</td>
                        <td><?php echo $title;?></td>

                        <td>
                            <?php
                                if($image_name!="")
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>photos/category/<?php echo $image_name;?>" width="100px" >

                                    <?php
                                }
                                else
                                {
                                    echo "Image not added";
                                }
                            ?>
                        </td>

                        <td><?php echo $featured;?></td>
                        <td><?php echo $active;?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>Admin/update-category.php?id=<?php echo $id?>" class="update-btn">Update Category</a>
                            <a href="<?php echo SITEURL;?>Admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="delete-btn">Delete Category</a>
                        </td>
                    </tr>
                    <?php
                    } // end while loop
                } // end if count > 0
                else
                {
                    ?>
                    <tr>
                        <td colspan="6"><div>No category added</div></td>
                    </tr>
                    <?php
                } // end else block
            } // end if res true
        ?>
    </table>
</div>
<?php 
    include('parts/footer.php');
?>
