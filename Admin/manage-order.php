<?php include('parts/menu.php'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
<link rel="stylesheet" href="1.css">

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center mb-8">Manage Orders</h1>

    <form method="GET" action="search.php" class="mb-6 flex justify-center">
        <input type="text" name="search" placeholder="Search..." required class="p-2 border border-gray-300 rounded-l-md focus:outline-none">
        <button type="submit" class="p-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700 transition">Search</button>
    </form>

    <div class="text-center mb-6">
        <a href="analytics.php" class="inline-block px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-900 transition">Analytics</a>
    </div>

    <?php
    if (isset($_SESSION['message'])) {
        echo "<div class='text-green-500 text-center mb-4'>{$_SESSION['message']}</div>";
        unset($_SESSION['message']);
    }
    ?>

    <?php
    $sql = "SELECT u.username, u.full_name, oi.item_name, oi.quantity, oi.item_price, o.order_date, o.id AS order_id
            FROM user_table u
            INNER JOIN order_table o ON u.id = o.user_id
            INNER JOIN ordered_table oi ON o.id = oi.order_id
            ORDER BY o.order_date DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $prevOrderId = null;
        ?>

        <div class='order-container'>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $currentOrderId = $row['order_id'];
                if ($currentOrderId !== $prevOrderId) {
                    if ($prevOrderId !== null) {
                        ?>
                        <div class="text-center mt-4">
                            <button class="reject-button inline-block px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                                <a href="reject_order.php?order_id=<?php echo $prevOrderId; ?>" class="no-underline text-white">Reject</a>
                            </button>
                            <button class="confirm-button inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                                <a href="confirm_order.php?order_id=<?php echo $prevOrderId; ?>" class="no-underline text-white">Confirm</a>
                            </button>
                        </div>
                        </table>
                    </div>
                        <?php
                    }
                    ?>
                    <div class='order-container bg-white shadow-md rounded-lg p-6 mb-6'>
                        <h2 class="text-xl font-semibold mb-4">Order ID: <?php echo $currentOrderId; ?></h2>
                        <table class='tbl w-full text-left'>
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="p-3">Id.</th>
                                    <th class="p-3">Username</th>
                                    <th class="p-3">Full name</th>
                                    <th class="p-3">Food name</th>
                                    <th class="p-3">Quantity</th>
                                    <th class="p-3">Price</th>
                                    <th class="p-3">Total Price</th>
                                    <th class="p-3">Order Date</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                }
                
                $totalPrice = $row['quantity'] * $row['item_price'];
                ?>
                <tr class="bg-white border-b">
                    <td class="p-3"><?php echo $row['order_id']; ?></td>
                    <td class="p-3"><?php echo $row['username']; ?></td>
                    <td class="p-3"><?php echo $row['full_name']; ?></td>
                    <td class="p-3"><?php echo $row['item_name']; ?></td>
                    <td class="p-3"><?php echo $row['quantity']; ?></td>
                    <td class="p-3"><?php echo $row['item_price']; ?></td>
                    <td class="p-3"><?php echo $totalPrice; ?></td>
                    <td class="p-3"><?php echo $row['order_date']; ?></td>
                </tr>
                <?php
                $prevOrderId = $currentOrderId;
            }
            ?>
            <div class="text-center mt-4">
                <button class="reject-button inline-block px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                    <a href="reject_order.php?order_id=<?php echo $currentOrderId; ?>" class="no-underline text-white">Reject</a>
                </button>
                <button class="confirm-button inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                    <a href="confirm_order.php?order_id=<?php echo $currentOrderId; ?>" class="no-underline text-white">Confirm</a>
                </button>
            </div>
            </table>
        </div>
        <?php
    } else {
        echo "<div class='text-center text-red-500'>No orders found</div>";
    }
    ?>
</div>

<?php include('parts/footer.php'); ?>
