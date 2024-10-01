<?php include('parts/menu.php'); ?>
<link rel="stylesheet" href="1.css">
<div class="main-content">
    <h1>Add Food</h1>
    <br>
    <br>
    <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
    ?>
    <br>
    <div class="form">
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter food name">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description"  cols="30" rows="4" placeholder="Enter food description"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" placeholder="enter price of food">
                    </td>
                </tr>
                <tr>
                    <td>Select image: </td>
                    <td>
                        <input type="file" name="image" placeholder="select image for food">
                    </td>
                </tr>
                <tr>
                    <td>Select Category: </td>
                    <td>
                        <select name="category">
                            <?php
                                $sql="SELECT * FROM category_table WHERE active='Yes'";
                                $res=mysqli_query($conn,$sql);
                                $count=mysqli_num_rows($res);
                                if($count>0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $id=$row['id'];
                                        $title=$row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0">No category found</option>
                                    <?php
                                }
                            ?>
                        </select>
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
                        <input type="submit" name="submit" value="Add Food" class="update-btn">
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
        $description=$_POST['description'];
        $price=$_POST['price'];
        $category=$_POST['category'];
        if(isset($_POST['featured']))
        {
            $featured=$_POST['featured'];
        }
        else
        {
            $featured="No";
        }
        if(isset($_POST['active']))
        {
            $active=$_POST['active'];
        }
        else
        {
            $active="No";
        }
        //checking whether the image is selected or not
        if(isset($_FILES['image']['name']))
        {
            $image_name=$_FILES['image']['name'];

            if($image_name!="")
            {
                $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                $image_name = "Food_name_" . rand(000, 999) . '.' . $ext;

                $source_path=$_FILES['image']['tmp_name'];
                $destination_path="../photos/food/".$image_name;

                $upload=move_uploaded_file($source_path,$destination_path);
                if($upload==false)
                {
                    $_SESSION['upload']="error in uploading image";
                    header("location:".SITEURL.'Admin/add-food.php');
                    die();
                }
            }
            else
            {
                $image_name="";
            }
        }
        $sql1 = "INSERT INTO food_table SET
        title='$title',
        description='$description',
        price='$price',
        image_name='$image_name',
        category_id='$category',
        featured='$featured',
        active='$active'";


        $res1=mysqli_query($conn,$sql1);
        if($res1==true)
        {
            $_SESSION['add food']="Food added succesfully";
            header("location:".SITEURL.'Admin/manage-food.php');
        }
        else
        {
            $_SESSION['add food']="failed to add food";
            header("location:".SITEURL.'Admin/manage-food.php');
        }
    }
?>

<?php include('parts/footer.php'); ?>
