<?php include('../cons/constants.php');
      include('authorization.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }
        body {
            font-family: 'Cedarville Cursive', cursive, 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        .navbar ul li a {
            text-decoration: none;
        }
        .navbar {
            border-bottom: 1px solid black; /* Add a thin line */
            padding: 3px;
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <ul>
            
            <li><a href="manage-admin.php">Admin</a></li>
            <li><a href="manage-category.php">Category</a></li>
            <li><a href="manage-food.php">Food</a></li>
            <li><a href="manage-order.php">Order</a></li>
            <li><a href="admin-logout.php">Logout</a></li>
        </ul>
    </div>
</body>
</html>
