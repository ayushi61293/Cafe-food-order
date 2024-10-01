<?php include('parts/menu.php'); ?>
<link rel="stylesheet" href="1.css">
    <div class="main-content">
        <h1>Update Food</h1>

        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
                $sql="SELECT * FROM food_table WHERE id=$id";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                if($count==1)
                {
                    $row=mysqli_fetch_assoc($res);
                    $title=$row['title'];
                    $current_image=$row['image_name'];
                    $description=$row['description'];
                    $price=$row['price'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                    $current_category=$row['category_id'];
                }
                else
                {
                    $_SESSION['no food']="No Food found";
                    header("location:".SITEURL.'Admin/manage-food.php');
                    exit(); // Add exit to stop execution after redirect
                }
            }
        ?>
        <div class="form">
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Description:
                        </td>
                        <td>
                            <textarea name="description"  cols="30" rows="4"><?php echo $description; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price :</td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price;?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Current Image:</td>
                        <td>
                        <?php 
                            if ($current_image != "") 
                            { 
                                ?>
                                    <img src="<?php echo SITEURL; ?>photos/food/<?php echo $current_image ?>" width="100px">
                                <?php 
                            } 
                            else 
                            { 
                                ?>
                                    Image not added
                                <?php 
                            } 
                                ?>

                        </td>
                    </tr>
                    <tr>
                        <td>Select new image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category">
                                <?php
                                    $sql1="SELECT * FROM category_table WHERE active='Yes'";
                                    $res1=mysqli_query($conn,$sql1);
                                    $count1=mysqli_num_rows($res1);
                                    if($count1>0)
                                    {
                                        while($row1=mysqli_fetch_assoc($res1))
                                        {
                                            $category_title=$row1['title'];
                                            $category_id=$row1['id'];
                                            ?>
                                                <option <?php if($current_category==$category_id) echo "selected"; ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="0">No category available</option>
                                        <?php
                                    }
                                ?>
                            </select>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured == "Yes") echo "checked"; ?> type="radio" name="featured" value="Yes">Yes
                            <input <?php if($featured=="No") echo "checked"; ?> type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php if($active=="Yes") echo "checked"; ?> type="radio" name="active" value="Yes">Yes
                            <input <?php if($active=="No") echo "checked"; ?> type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Food" class="update-btn">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php
    if(isset($_POST['submit']))
    {
        $id=$_POST['id'];
        $title=$_POST['title'];
        $price=$_POST['price'];
        $description=$_POST['description'];
        $featured=$_POST['featured'];
        $active=$_POST['active'];
        $category=$_POST['category'];
        $current_image=$_POST['current_image'];

        if(isset($_FILES['image']['name']))
        {
            $image_name = $_FILES['image']['name'];
            if($image_name != "")
            {
                $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                $image_name = "Food_name_" . rand(000, 999) . '.' . $ext;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../photos/food/" . $image_name;

                // Upload the new image
                if(move_uploaded_file($source_path, $destination_path))
                {
                    // Remove the old image if it exists
                    if($current_image != "")
                    {
                        $remove_path = "../photos/food/" . $current_image;
                        unlink($remove_path);
                    }
                }
                else
                {
                    $_SESSION['upload-image'] = "Error in uploading image";
                    header('location:'.SITEURL.'Admin/manage-food.php');
                    exit(); // Add exit to stop execution after redirect
                }
            }
            else
            {
                $image_name = $current_image; // Use the current image name if no new image is uploaded
            }
        }
        else
        {
            $image_name = $current_image; // Use the current image name if no new image is uploaded
        }

        $sql2="UPDATE food_table SET
        title='$title',
        price=$price,
        featured='$featured',
        active='$active',
        description='$description',
        category_id='$category',
        image_name='$image_name'
        WHERE id=$id
        ";

        $res2=mysqli_query($conn,$sql2);
        if($res2==true)
        {
            $_SESSION['update food'] = "Food updated successfully";
            header('location:'.SITEURL.'Admin/manage-food.php');
            exit();
        }
        else
        {
            $_SESSION['update food'] = "Failed to update food";
            header('location:'.SITEURL.'Admin/manage-food.php');
            exit();
        }
    }
?>
<?php include('parts/footer.php'); ?>