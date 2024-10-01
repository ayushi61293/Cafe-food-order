<?php include('parts/menu.php'); ?>
<link rel="stylesheet" href="1.css">
<div class="main-content">
    <h1>Add Category</h1>
    <br>
    <br>
    <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
    ?>
    <div class="form">
        <form action="" method="POST" enctype="multipart/form-data">
            <table width=30%>
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="enter title for category">
                    </td>
                </tr>
                
                <tr>
                    <td>Select image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="update-btn">
                        </td>
                    </tr>
            </table>
        </form>
    </div>
</div>
<?php
    if(isset($_POST['submit']))
    {
        $title=$_POST['title'];
        if(isset($_POST['featured']))
        {
            $featured=$_POST['featured'];
        }
        else
        {
            $featured="";
        }
        if(isset($_POST['active']))
        {
            $active=$_POST['active'];
        }
        else
        {
            $active="";
        }
        //check whether the image is selected or not and set the value for image accordingly
        if(isset($_FILES['image']['name']))
        {
            //to upload the image we need image name, source path and destination
            $image_name=$_FILES['image']['name'];
            if($image_name!="")
            {
            //Auto rename our image
                $ext=end(explode('.',$image_name));
                $image_name="Food_category_".rand(000,999).'.'.$ext;

                $source_path=$_FILES['image']['tmp_name'];
                $destination_path="../photos/category/".$image_name;

                //Finally upload the image
                $upload=move_uploaded_file($source_path,$destination_path);
                //check whether the image is uploaded or not
                if($upload==false)
                {
                    $_SESSION['upload']="error in uploading image";
                    header("location:".SITEURL.'Admin/add-category.php');
                    die();
                }
            }
        }
        else
        {
            $image_name="";
        }

        $sql="INSERT INTO category_table SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        ";

        $res=mysqli_query($conn,$sql);
        if($res==true)
        {
            $_SESSION['add category']="Category added succesfully";
            header("location:".SITEURL.'Admin/manage-category.php');
        }
        else
        {
            $_SESSION['add category']="Failed to add category";
            header("location:".SITEURL.'Admin/manage-category.php');
        }
    }
?>