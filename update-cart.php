<?php
// Include necessary files and start session
include('front-parts/home.php');
session_start();
if(isset($_POST['item_id']) && $_POST['quantity']) 
{
    $item_id = $_POST['item_id'];
    $quantity=$_POST['quantity'];

    // Query to delete the item from the cart
    $sql = "UPDATE cart_table SET
    quantity=$quantity
    WHERE id = $item_id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check if the query was successful
    if($res) {
        // Set success message in session
        $_SESSION['update-cart'] = "Item updated successfully.";
    } else {
        // Set error message in session
        $_SESSION['delete'] = "Failed to update item.";
    }

    // Redirect back to the cart page
    header("Location:".SITEURL.'manage-cart.php');
    exit();
} else {
    // If item ID is not set in POST request, redirect back to the cart page
    header("Location:".SITEURL.'manage-cart.php');
    exit();
}
?>