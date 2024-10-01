<?php 
include('front-parts/home.php'); 

if(isset($_POST['price']) && $_POST['user1'])
{
    $total_price=$_POST['price'];
    $username=$_POST['user1'];
    $currentDateTime = date('Y-m-d H:i:s');

    $sql1="SELECT id FROM user_table WHERE username='$username'";
    $res1=mysqli_query($conn,$sql1);
    if(mysqli_num_rows($res1)>0)
    {
        $row1=mysqli_fetch_assoc($res1);
        $user_id=$row1['id'];
    }

    // Insert into order_table
    $sql_order = "INSERT INTO order_table (user_id,total_price,order_date,order_status) VALUES ('$user_id','$total_price', '$currentDateTime', 'pending')";
    $res_order = mysqli_query($conn, $sql_order);

    if($res_order) 
    {
        // Get the order ID of the inserted row
        $order_id = mysqli_insert_id($conn);

        // Iterate through items in the cart to insert into ordered_items table
        $sql_cart = "SELECT * FROM cart_table";
        $res_cart = mysqli_query($conn, $sql_cart);

        while ($row_cart = mysqli_fetch_assoc($res_cart)) {
            $item_id = $row_cart['id'];
            $item_name = $row_cart['item_name'];
            $item_price = $row_cart['item_price'];
            $quantity = $row_cart['quantity'];

            // Insert into ordered_items table
            $sql_ordered_items = "INSERT INTO ordered_table (user_id,order_id, item_name, item_price, quantity) 
                                  VALUES ('$user_id','$order_id', '$item_name', '$item_price', '$quantity')";
            mysqli_query($conn, $sql_ordered_items);
        }

        // Clear the cart after successful order
        $sql_clear_cart = "DELETE FROM cart_table";
        mysqli_query($conn, $sql_clear_cart);

        // Set success message in session
        $_SESSION['order'] = "Wait a few seconds for confirmation.";
        header("Location:".SITEURL.'manage-cart.php');
        exit();
    } else {
        // Set error message in session
        $_SESSION['order'] = "Order Failed";
        header("Location:".SITEURL.'manage-cart.php');
        exit();
    }
}
?>
