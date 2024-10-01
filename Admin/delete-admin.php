<?php
    include('../cons/constants.php');
    //to get the id of admin to be deleted
    $id=$_GET['id'];

    //writing query for deleting admin
    $sql="DELETE FROM admin_table WHERE id=$id";
    //executing the query
    $res=mysqli_query($conn,$sql);

    if($res==true)
    {
        $_SESSION['delete']='Admin deleted Succesfully';
        header("location:".SITEURL.'Admin/manage-admin.php');
    }   
    else
    {
        $_SESSION['delete']='Failed to delete admin try again';
        header("location:".SITEURL.'Admin/manage-admin.php');
    }

?>