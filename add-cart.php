<?php
include('C:\xampp\htdocs\Food Order Website\cons\constants.php');
session_start(); // Start the session

if(isset($_POST['id']) && isset($_POST['title']) && isset($_POST['price']) && isset($_POST['quantity']) && isset($_POST['user1'])) 
{
    $username=$_POST['user1'];
    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql1="SELECT id FROM user_table WHERE username='$username'";
    $res1=mysqli_query($conn,$sql1);
    if(mysqli_num_rows($res1)>0)
    {
        $row1=mysqli_fetch_assoc($res1);
        $user_id=$row1['id'];
    }

    // Check if item already exists in the cart
    $sql = "SELECT * FROM cart_table WHERE item_id=$id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        // Item already exists, update quantity
        $row = mysqli_fetch_assoc($result);
        $newQuantity = $row['quantity'] + $quantity;
        $updateSql = "UPDATE cart_table SET quantity=$newQuantity WHERE item_id=$id";
        $updateRes = mysqli_query($conn, $updateSql);

        if($updateRes) {
            $_SESSION['cart-add'] = "Added to cart successfully";
            header("location:".SITEURL.'food.php');
            exit;
        } 
        else 
        {
            $_SESSION['cart-add'] = "Failed to update cart";
            header("location:".SITEURL.'food.php');
            exit;
        }
    } else {
        // Item doesn't exist, insert new row
        $insertSql = "INSERT INTO cart_table (user_id,item_id, item_name, item_price, quantity) 
                      VALUES ($user_id,$id, '$title', $price, $quantity)";
        $insertRes = mysqli_query($conn, $insertSql);

        if($insertRes) {
            $_SESSION['cart-add'] = "Added to cart successfully";
            header("location:".SITEURL.'food.php');
            exit;
        } else {
            $_SESSION['cart-add'] = "Failed to add to cart";
            header("location:".SITEURL.'food.php');
            exit;
        }
    }
}
?>
