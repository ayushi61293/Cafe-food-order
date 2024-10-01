<?php
    include('../cons/constants.php');
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        if($image_name!="")
        {
            $path="../photos/food/".$image_name;

            if(file_exists($path)) 
            {
                $remove=unlink($path);
                if($remove==false)
                {
                    $_SESSION['failed to remove image']="Failed to remove food image";
                    header('Location:'.SITEURL.'Admin/manage-food.php');
                    die();
                }
            }
        }
        $sql="DELETE FROM food_table WHERE id=$id";
        $res=mysqli_query($conn,$sql);
        if($res==true)
        {
            $_SESSION['delete']="Food deleted successfully";
            header('Location:'.SITEURL.'Admin/manage-food.php');
        }
        else
        {
            $_SESSION['delete']="Failed to delete food";
            header('Location:'.SITEURL.'Admin/manage-food.php');
        }
    }
    else
    {
        header('Location:'.SITEURL.'Admin/manage-food.php');
    }
?>
