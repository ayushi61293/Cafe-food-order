<?php include('parts/menu.php'); ?>
<link rel="stylesheet" href="1.css">
<div class="main-content">
    <h1>Update Category</h1>

    <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
            $sql="SELECT * FROM category_table WHERE id=$id";

            $res=mysqli_query($conn,$sql);
            if($res==true)
            {
                $count=mysqli_num_rows($res);
                if($count==1)
                {
                    $row=mysqli_fetch_assoc($res);
                    $id=$row['id'];
                    $title=$row['title'];
                    $current_image=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                }
                else
                {
                    $_SESSION['no category']="No category found";
                    header("location:".SITEURL.'Admin/manage-category.php');
                    exit(); // Add exit to stop execution after redirect
                } 
            }
        }
        else
        {
            header("location:".SITEURL.'Admin/manage-category.php');
            exit(); // Add exit to stop execution after redirect
        }
    ?>

    <div class="form">
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php
                         if($current_image != ""): ?>
                            <img src="<?php echo SITEURL; ?>photos/category/<?php echo $current_image ?>" width="100px">
                        <?php else: ?>
                            Image not added
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td>New image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input <?php if($featured == "Yes") echo "checked"; ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured == "No") echo "checked"; ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <input <?php if($active == "Yes") echo "checked"; ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active == "No") echo "checked"; ?> type="radio" name="active" value="No">No
                    </td> 
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="update-btn">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
        $active = isset($_POST['active']) ? $_POST['active'] : "No";

        // Check if a new image is uploaded
        if(isset($_FILES['image']['name']))
        {
            $image_name = $_FILES['image']['name'];
            if($image_name != "")
            {
                $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                $image_name = "Food_category_" . rand(000, 999) . '.' . $ext;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../photos/category/" . $image_name;

                // Upload the new image
                if(move_uploaded_file($source_path, $destination_path))
                {
                    // Remove the old image if it exists
                    if($current_image != "")
                    {
                        $remove_path = "../photos/category/" . $current_image;
                        unlink($remove_path);
                    }
                }
                else
                {
                    $_SESSION['upload-image'] = "Error in uploading image";
                    header("location:".SITEURL.'Admin/manage-category.php');
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

        $sql1 = "UPDATE category_table SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        WHERE id=$id
        ";

        $res1 = mysqli_query($conn, $sql1);
        if($res1)
        {
            $_SESSION['update category'] = "Category updated successfully";
            header("location:".SITEURL.'Admin/manage-category.php');
            exit(); // Add exit to stop execution after redirect
        }
        else
        {
            $_SESSION['update category'] = "Failed to update category";
            header("location:".SITEURL.'Admin/manage-category.php');
            exit(); // Add exit to stop execution after redirect
        }
    }
?>

<?php include('parts/footer.php'); ?>
