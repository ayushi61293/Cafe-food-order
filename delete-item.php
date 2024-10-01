<?php
// Include necessary files and start session
include('front-parts/home.php');
session_start();
if(isset($_POST['item_id'])) {
    
    $item_id = $_POST['item_id'];

    $sql = "DELETE FROM cart_table WHERE id = $item_id";
    $res = mysqli_query($conn, $sql);
    if($res==true) 
    {
        $_SESSION['delete'] = "Item deleted successfully.";
        header("Location:".SITEURL.'manage-cart.php');
        exit();
    } else {
        // Set error message in session
        $_SESSION['delete'] = "Failed to delete item.";
        header("Location:".SITEURL.'manage-cart.php');
        exit();
    }

    // Redirect back to the cart page
    
} else
{
    // If item ID is not set in POST request, redirect back to the cart page
    header("Location:".SITEURL.'manage-cart.php');
    exit();
}
?>