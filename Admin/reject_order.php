<?php include('parts/menu.php');
if(isset($_GET['order_id'])) 
{
    $orderId = $_GET['order_id'];

    $sql="UPDATE order_table SET
    order_status='Rejected'
    WHERE id=$orderId";

    $res=mysqli_query($conn,$sql);
    if($res==true)
    {
        $_SESSION['message'] = "Order with ID $orderId Rejected due to some unaviodable reasons.";
        $_SESSION['order_updated'] = true;
        header("Location:".SITEURL.'Admin/manage-order.php');
        exit();
    }
    else
    {
        $_SESSION['message'] = "Failed to Reject order.";
        header("Location:".SITEURL.'Admin/manage-order.php');
        exit();
    }
 
    
}

?>