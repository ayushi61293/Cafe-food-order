<?php
include('front-parts/home.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <style>
        /* Your existing CSS styles */
        body {
            font-family: 'Cedarville Cursive', cursive, 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-image: url('https://t4.ftcdn.net/jpg/02/10/80/37/360_F_210803786_qXjc6ycwK4hTNV3glV0vNlhHJMpXxdFe.jpg');
            background-size: cover;
            background-position: center;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(40, 40, 40, 0.5); /* Adjust the opacity (fourth value) as needed */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        h1, h2 {
            color: #1DB954;
            text-align: center;
        }

        .profile-info {
            margin-bottom: 30px;
        }

        .profile-info p {
            margin: 10px 0;
            font-size: 18px;
        }

        .profile-info p strong {
            font-weight: bold;
        }

        .order-history {
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #555;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #535353; /* Muted gray color */
            font-weight: bold;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #333;
        }

        tr:hover {
            background-color: #444;
        }

        .expandable-row {
            cursor: pointer;
        }

        .expandable-row:hover {
            background-color: #555;
        }

        .expanded-row {
            display: none;
            background-color: #555;
        }

        .expanded-row td {
            padding: 12px;
        }

        .custom-btn {
            text-align: center;
            margin-top: 20px;
        }

        .custom-btn a {
            display: inline-block;
            padding: 12px 24px;
            background-color: #1DB954;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .custom-btn a:hover {
            background-color: #1ED760;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php 
        if(isset($_SESSION['user1'])) {
            // User is logged in, show profile information and order history
            $username = $_SESSION['user1'];

            // Fetch user details
            $sql = "SELECT * FROM user_table WHERE username='$username'";
            $res = mysqli_query($conn, $sql);

            if(mysqli_num_rows($res) > 0) 
            {
                $user_row = mysqli_fetch_assoc($res);
                $fullname = $user_row['full_name'];
                $email = $user_row['email'];
                $userid = $user_row['id'];
                // Display user profile information
                ?>
                <h1>Your Profile</h1>
                <br>
                <?php
                if(isset($_SESSION['order_updated'])) 
                {
                    // If the order status is just updated, fetch and display it
                    $sql1 = "SELECT * FROM order_table WHERE order_status!='pending' && user_id=$userid";
                    $res1 = mysqli_query($conn, $sql1);
                    if(mysqli_num_rows($res1) == 1) 
                    {
                        $row = mysqli_fetch_assoc($res1);
                        $orderstatus = $row['order_status'];
                        echo "Your order status is $orderstatus";
                    }
                    // Unset the session flag after displaying the order status
                    unset($_SESSION['order_updated']);
                }
                ?>
                <br>
                <br>
                <div class="profile-info">
                    <p><strong>Username:</strong><?php echo $username; ?></p>
                    <p><strong>Full Name:</strong><?php echo $fullname; ?></p>
                    <p><strong>Email:</strong><?php echo $email; ?></p>
                </div>

                <?php
                // Fetch user's order history
                $order_sql = "SELECT o.id AS order_id, GROUP_CONCAT(oi.item_name SEPARATOR '<br>') AS item_names, 
                              GROUP_CONCAT(oi.quantity SEPARATOR '<br>') AS quantities, 
                              GROUP_CONCAT(oi.item_price SEPARATOR '<br>') AS item_prices, 
                              o.order_date 
                              FROM order_table o
                              INNER JOIN ordered_table oi ON o.id = oi.order_id
                              INNER JOIN user_table u ON o.user_id = u.id
                              WHERE u.username='$username'
                              GROUP BY o.id, o.order_date";
                $order_result = mysqli_query($conn, $order_sql);

                if(mysqli_num_rows($order_result) > 0) 
                {
                    ?>
                    <div class="order-history">
                        <h2>Order History</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Items</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($order_row = mysqli_fetch_assoc($order_result)) 
                                {
                                    ?>
                                    <tr class="expandable-row" onclick="toggleRow(this)">
                                        <td>#<?php echo $order_row['order_id']; ?></td>
                                        <td><?php echo $order_row['item_names']; ?></td>
                                        <td><?php echo $order_row['order_date']; ?></td>
                                    </tr>
                                    <tr class="expanded-row">
                                        <td colspan="3">
                                            <strong>Quantities:</strong><br>
                                            <?php echo $order_row['quantities']; ?><br><br>
                                            <strong>Prices:</strong><br>
                                            <?php echo $order_row['item_prices']; ?><br>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                } 
                else 
                {
                    echo "<p>No orders found.</p>";
                }
                ?>
                <div class="custom-btn">
                    <a href="User/user-logout.php">Logout</a>
                </div>
                <?php
            }
        } else {
            // User is not logged in, show login option
            ?>
            <h1>Login Required</h1>
            <div class="custom-btn">
                <a href="User/user-login.php">Login</a>
            </div>
            <?php
        }
        ?>

        <script>
            function toggleRow(row) {
                const expandedRow = row.nextElementSibling;
                expandedRow.style.display = (expandedRow.style.display === 'table-row') ? 'none' : 'table-row';
            }
        </script>

    </div>
</body>
</html>
