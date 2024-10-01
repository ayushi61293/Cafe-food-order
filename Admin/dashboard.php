<?php include('parts/menu.php'); ?>
<link rel="stylesheet" href="1.css">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Four Containers</title>
    <style>
        /* CSS for container layout */

        .container {
            width: calc(50% - 30px); /* Adjust as needed */
            padding: 20px;
            margin: 10px;
            border: none;
            box-sizing: border-box;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add box shadow */
            background: pink;
            float: left; /* Float the containers */
        }

        /* CSS to align two containers in a row */
        .container-row {
            width: calc(100% - 250px); /* Adjust for the sidebar width */
            margin-left: 250px; /* Adjust for the sidebar width */
            overflow: hidden; /* Clear floats */
        }

        @media (max-width: 768px) {
            .container {
                width: 90%; /* Adjust as needed */
                float: none; /* Reset float property for mobile */
                margin: 0 auto; /* Center containers on mobile */
            }
            .container-row {
                width: 100%;
                margin-left: 0;
            }
        }
        .sidebar {
        height: 100%;
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #333;
        padding-top: 20px;
    }

    .sidebar h2 {
        color: #fff;
        text-align: center;
        margin-bottom: 30px;
    }

    .sidebar ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .sidebar ul li {
        padding: 10px 20px;
        border-bottom: 1px solid #444;
    }

    .sidebar ul li a {
        color: #fff;
        text-decoration: none;
    }

    .sidebar ul li a:hover {
        color: #1DB954;
    }
    </style>
</head>
<body>
<div class="sidebar">
    <h2>Sidebar</h2>
    <ul>
        <li><a href="#">Dashboard</a></li>
        <li><a href="manage-order.php">Orders</a></li>
        <li><a href="customers.php">Customers</a></li>
        <li><a href="analytics.php">Analytics</a></li>
        <li><a href="#">Settings</a></li>
    </ul>
</div>
    <div class="container-row">
        <div class="container">
            <h2><a href="">Total Orders</a></h2>
            <p>This is the content of container 1.</p>
        </div>
        <div class="container">
            <h2><a href="">Confirmed Orders</a></h2>
            <p>This is the content of container 2.</p>
        </div>
    </div>
    <div class="container-row">
        <div class="container">
            <h2>Rejected Orders</h2>
            <p>This is the content of container 3.</p>
        </div>
        <div class="container">
            <h2>Total Users</h2>
            <p>This is the content of container 4.</p>
        </div>
    </div>
</body>
</html>
