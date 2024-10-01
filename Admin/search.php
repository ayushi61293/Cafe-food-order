<?php
include('parts/menu.php');
?>

<link rel="stylesheet" href="1.css">

<style>
    /* Main Content Styles */
    .main-content {
        padding: 20px;
    }

    .main-content h1 {
        color: #333;
        text-align: center;
        margin-bottom: 30px;
    }

    .tbl {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .tbl th, .tbl td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    .tbl th {
        background-color: #f2f2f2;
    }

    .tbl td {
        background-color: #fff;
    }
</style>

<div class="main-content">
    <h1>Search Results</h1>

    <?php
    // Check if a search term is provided
    if(isset($_GET['search']) && !empty($_GET['search'])) {
        // Get the search term and escape it to prevent SQL injection
        $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
        
        // Construct the SQL query to select data
        $sql = "SELECT u.username, u.full_name, oi.item_name, oi.quantity, oi.item_price, o.order_date, o.id AS order_id
                FROM user_table u
                INNER JOIN order_table o ON u.id = o.user_id
                INNER JOIN ordered_table oi ON o.id = oi.order_id
                WHERE oi.item_name LIKE '%$searchTerm%'
                ORDER BY o.id";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check if there are results
        if(mysqli_num_rows($result) > 0) {
            // Display the results in a table
            echo "<table class='tbl'>";
            echo "<tr>
                    <th>Username</th>
                    <th>Full name</th>
                    <th>Food name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Order Date</th>
                </tr>";
            while($row = mysqli_fetch_assoc($result)) {
                // Calculate total price for the current item
                $totalPrice = $row['quantity'] * $row['item_price'];
                
                // Display the row
                echo "<tr>
                        <td>{$row['username']}</td>
                        <td>{$row['full_name']}</td>
                        <td>{$row['item_name']}</td>
                        <td>{$row['quantity']}</td>
                        <td>{$row['item_price']}</td>
                        <td>{$totalPrice}</td>
                        <td>{$row['order_date']}</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            // If no results are found, display a message
            echo "<p>No orders found for the searched item.</p>";
        }
    } else {
        // If no search term is provided, display a message
        echo "<p>No search term provided.</p>";
    }
    ?>

</div>

<?php
include('parts/footer.php');
?>
