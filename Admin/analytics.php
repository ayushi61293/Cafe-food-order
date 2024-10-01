<?php include('parts/menu.php'); ?>
<link rel="stylesheet" href="1.css">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Most Sold Items</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <?php
    // Your PHP code here
    // Fetch most sold items
    $sql = "SELECT item_name, SUM(quantity) AS total_quantity 
            FROM ordered_table 
            GROUP BY item_name 
            ORDER BY total_quantity DESC";
    $result = mysqli_query($conn, $sql);
    ?>
    <h2 class="text-2xl font-bold text-center mb-4">Most Sold Items</h2>
    <?php if (mysqli_num_rows($result) > 0): ?>
    <table class="min-w-full bg-white shadow-md rounded-md overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-6 py-3 text-left font-semibold text-sm">S.No.</th>
                <th class="px-6 py-3 text-left font-semibold text-sm">Item Name</th>
                <th class="px-6 py-3 text-left font-semibold text-sm">Total Quantity Sold</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php
            $serialNumber = 1;
            while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap"><?php echo $serialNumber; ?></td>
                <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['item_name']; ?></td>
                <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['total_quantity']; ?></td>
            </tr>
            <?php $serialNumber++; endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p class="text-center mt-4">No data found</p>
    <?php endif; ?>
</div>

<footer class="text-center mt-8 bg-gray-900 text-white py-4">
    &copy; 2024 By Ayushi Gumashta and Abhinav Yadav
</footer>

</body>
</html>
