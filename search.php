<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering Website</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-white">

    <?php include('front-parts/home.php'); ?>

   

    <section class="food-menu py-10 bg-gray-900 bg-opacity-90 text-white">
        <div class="text-center mb-8">
            <?php
            if (isset($_POST['submit']) && $_POST['submit'] === 'search food') {
                $search = htmlspecialchars($_POST['search']);
                echo "<h1 class='text-3xl font-semibold'>Food on your search: <span class='text-blue-500'>{$search}</span></h1>";
            }
            ?>
            <h2 class="text-2xl mt-4">Available Food</h2>
        </div>
        <div class="menu-container max-w-6xl mx-auto">
            <div class="menu-row flex flex-wrap justify-between gap-6">
                <?php
                $sql1 = "SELECT * FROM food_table WHERE title LIKE '%$search%'";
                $res1 = mysqli_query($conn, $sql1);
                $count1 = mysqli_num_rows($res1);
                if ($count1 > 0) {
                    while ($row1 = mysqli_fetch_assoc($res1)) {
                        $id1 = $row1['id'];
                        $title1 = $row1['title'];
                        $price = $row1['price'];
                        $description = $row1['description'];
                        $image_name1 = $row1['image_name'];
                ?>
                <div class="menu-box flex flex-col md:flex-row items-center w-full md:w-1/2 lg:w-1/3 p-6 bg-gray-800 text-white rounded-lg shadow-lg">
                    <div class="flex-shrink-0">
                        <img src="<?php echo SITEURL; ?>photos/food/<?php echo $image_name1; ?>" alt="<?php echo $title1; ?>" class="w-32 h-32 object-cover rounded-lg mb-4 md:mb-0 md:mr-4">
                    </div>
                    <div class="text-center md:text-left flex-grow">
                        <p class="text-2xl font-bold mb-2"><?php echo $title1; ?></p>
                        <p class="food-price text-lg text-green-400 mb-2"><?php echo $price; ?></p>
                        <p class="food-details text-sm mb-4"><?php echo $description; ?></p>
                        <form action="<?php echo SITEURL; ?>add-cart.php" method="POST" class="flex items-center justify-center md:justify-start space-x-4">
                            <input type="hidden" name="user1" value="<?php echo $_SESSION['user1']; ?>">
                            <input type="hidden" name="id" value="<?php echo $id1; ?>">
                            <input type="hidden" name="title" value="<?php echo $title1; ?>">
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                            <input type="number" name="quantity" value="1" min="1" max="10" class="p-2 text-gray-900 rounded-md w-16">
                            <button type="submit" class="btn inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 transition-all" name="add_to_cart">Add to Cart</button>
                        </form>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo "<p class='text-center text-red-500'>No food items available.</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <?php include('front-parts/footer1.php'); ?>

</body>

</html>
