<?php include('front-parts/home.php'); 
include('front-parts/user-authorization.php'); 
?>
<style>
    /* CSS styles for the Manage Cart section */

    .manage-cart-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .manage-cart-title {
        text-align: center;
    }

    .message-container {
        margin-bottom: 20px;
    }

    .message {
        margin: 10px 0;
        padding: 10px;
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
    }

    .cart-table th,
    .cart-table td {
        padding: 8px;
        text-align: left;
    }

    .cart-table th {
        background-color: #f2f2f2;
    }

    .cart-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .order-btn {
        background-color: #4CAF50;
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .order-btn:hover {
        background-color: #45a049;
    }

    .update-btn {
        background-color: #007bff;
        color: white;
        padding: 6px 12px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .update-btn:hover {
        background-color: #0056b3;
    }
    .delete-btn {
        background-color: #f44336;
        color: white;
        padding: 6px 12px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .delete-btn:hover {
        background-color: #d32f2f;
    }
</style>

<div class="manage-cart-container">
    <h1 class="manage-cart-title">Manage Cart</h1>
    <div class="message-container">
        <?php
        // Display messages if set in session
        $messages = ['add', 'delete', 'Update', 'password updated', 'password not matched', 'no user found', 'admin-login'];
        foreach ($messages as $message) {
            if (isset($_SESSION[$message])) {
                echo '<p class="message">' . $_SESSION[$message] . '</p>';
                unset($_SESSION[$message]);
            }
        }
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        ?>
    </div>
    <table class="cart-table">
        <tr>
            <th>#</th>
            <th>Item Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Action</th>
        </tr>
        <?php
        // Select query to fetch data from cart_table
        $sql = "SELECT * FROM cart_table";
        $res = mysqli_query($conn, $sql);
        $totalPrice = 0;
        if ($res && mysqli_num_rows($res) > 0) 
        {
            $num = 1;
           
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['item_name'];
                $price = $row['item_price'];
                $quantity = $row['quantity'];
                $totalItemPrice = $price * $quantity;
                $totalPrice += $totalItemPrice;
        ?>
                <tr>
                    <td><?php echo $num++; ?></td>
                    <td><?php echo $title; ?></td>
                    <td><?php echo $price; ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td><?php echo $totalItemPrice; ?></td>
                    <td>
                        <form action="update-cart.php" method="post">
                            <input type="hidden" name="item_id" value="<?php echo $id; ?>">
                            <button type="button" class="decrement-btn">-</button>
                            <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1" max="10">
                            <button type="button" class="increment-btn">+</button>
                            <button type="submit" class="update-btn">Update</button>
                        </form>
                    </td>

                    <td>
                        <form action="delete-item.php" method="post">
                            <input type="hidden" name="item_id" value="<?php echo $id; ?>">
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo '<tr><td colspan="6">No items in the cart.</td></tr>';
        }
        ?>
        <tr>
            <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
            <td><strong><?php echo $totalPrice; ?></strong></td>
            <td></td>
        </tr>
    </table>
    <div class="order-now-btn" <?php if(mysqli_num_rows($res) == 0) echo 'style="display: none;"'; ?>>
    <form action="order.php" method="post">
        <input type="hidden" name="user1" value="<?php echo $_SESSION['user1']; ?>">
        <input type="hidden" name="price" value="<?php echo $totalPrice; ?>">
        <button type="submit" class="order-btn">Order now</button>
    </form>
</div>

</div>
<script>
    // Get all increment and decrement buttons
    const decrementBtns = document.querySelectorAll('.decrement-btn');
    const incrementBtns = document.querySelectorAll('.increment-btn');

    // Add click event listeners to decrement buttons
    decrementBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const quantityInput = btn.nextElementSibling;
            let newQuantity = parseInt(quantityInput.value) - 1;
            if (newQuantity < 1) {
                newQuantity = 0;
                // If quantity is zero, remove the row
                btn.closest('tr').remove();
            } else {
                quantityInput.value = newQuantity;
            }
        });
    });

    // Add click event listeners to increment buttons
    incrementBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const quantityInput = btn.previousElementSibling;
            let newQuantity = parseInt(quantityInput.value) + 1;
            if (newQuantity > 10) {
                newQuantity = 10;
            }
            quantityInput.value = newQuantity;
        });
    });
</script>
