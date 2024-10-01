<?php
 include('C:\xampp\htdocs\Food Order Website\cons\constants.php');

?>
<style>
    body {
        margin: 0;
        font-family: 'Cedarville Cursive', cursive, 'Helvetica Neue', Helvetica, Arial, sans-serif;
        background-color: #f5f5f5;
        color: #333;
    }

    header {
        background-color: #222;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    nav ul {
        display: flex;
        list-style: none;
        padding: 0;
    }

    nav ul li {
        margin: 0 15px;
    }

    nav ul li a {
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s ease;
    }

    nav ul li a:hover {
        color: #ff8c00;
    }
</style>

<header>
    <div class="logo">
    <img src="front-parts/img1.png" alt="Logo">

    </div>
    <nav>
        <ul>
            <li><a href="<?php echo SITEURL;?>index.php">Home</a></li>
            <li><a href="<?php echo SITEURL;?>category.php">Categories</a></li>
            <li><a href="<?php echo SITEURL;?>food.php">Food</a></li>
            <li><a href="<?php echo SITEURL;?>Admin/admin-login.php">Admin</a></li>
            <li><a href="<?php echo SITEURL;?>manage-cart.php">Cart</a></li>
            <li><a href="<?php echo SITEURL;?>profile.php">Profile</a></li>
        </ul>
    </nav>
</header>
<?php
    if(isset($_SESSION['user-login']))
    {
        echo $_SESSION['user-login'];
        unset($_SESSION['user-login']);
    }
?>
