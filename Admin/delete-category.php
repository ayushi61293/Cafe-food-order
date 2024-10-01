<?php
    include('../cons/constants.php');
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file if available
        if($image_name != "")
        {
            $path = "../photos/category/".$image_name;
            // Check if the file exists before attempting to delete
            if(file_exists($path)) {
                $remove = unlink($path);
                // If failed to remove image then add an error message
                if($remove == false)
                {
                    $_SESSION['remove'] = "Failed to remove category image";
                    header('location:'.SITEURL.'Admin/manage-category.php');
                    exit(); // Stop script execution
                }
            }
        }

        // Delete data from database
        $sql = "DELETE FROM category_table WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if($res == true)
        {
            $_SESSION['delete'] = "Category deleted successfully";
        }
        else
        {
            $_SESSION['delete'] = "Failed to delete category";
        }
    }
    // Redirect to manage category page regardless of success or failure
    header('location:'.SITEURL.'Admin/manage-category.php');
    exit(); // Stop script execution
?>
