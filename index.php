<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering Website</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <?php include('front-parts/home.php'); ?>
    <?php include('front-parts/user-authorization.php'); ?>

    <section class="about-us py-10 bg-gray-100">
        <div class="content text-center max-w-6xl mx-auto">
            <h2 class="text-3xl font-semibold mb-8">Welcome to our Cafe</h2>
            <div class="about-row flex flex-wrap justify-center items-center gap-6">
                <div class="about-text w-full md:w-1/2 p-6">
                    <h3 class="text-2xl font-bold mb-4"></h3>
                    <p class="text-lg mb-4">We are dedicated to providing the best culinary experience with our diverse menu and exquisite flavors. Our team of experienced chefs uses only the freshest ingredients to create dishes that will leave you coming back for more.</p>
                    <p class="text-lg mb-4">Our cafe is more than just a place to eat. It's a place where friends and family come together to enjoy delicious food in a warm and welcoming atmosphere. We pride ourselves on our exceptional service and commitment to quality.</p>
                    <p class="text-lg">Come visit us and experience the taste of excellence.</p>
                </div>
                
            </div>
        </div>
    </section>

    <section class="food-menu py-10">
    <h2 class="text-3xl font-semibold text-center mb-8">Food Menu</h2>
    <div class="menu-container max-w-6xl mx-auto">
        <div class="menu-row flex flex-wrap justify-center gap-6">
            <?php
            $sql1 = "SELECT * FROM food_table WHERE featured='Yes' AND active='Yes' LIMIT 4";
            $res1 = mysqli_query($conn, $sql1);
            $count1 = mysqli_num_rows($res1);
            if ($count1 > 1) {
                while ($row1 = mysqli_fetch_assoc($res1)) {
                    $id1 = $row1['id'];
                    $title1 = $row1['title'];
                    $price = $row1['price'];
                    $description = $row1['description'];
                    $image_name1 = $row1['image_name'];
            ?>
            <div class="menu-box flex flex-col md:flex-row items-center w-full md:w-1/2 p-6 bg-gray-800 text-white rounded-lg shadow-lg">
                <img src="<?php echo SITEURL; ?>photos/food/<?php echo $image_name1; ?>" alt="<?php echo $title1; ?>" class="w-32 h-32 object-cover rounded-lg mr-4">
                <div class="text-center md:text-left">
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
                // Handle case where no food items are found
                echo '<div class="text-center w-full p-6 bg-gray-100 rounded-lg shadow-lg">
                        <p class="text-2xl font-bold mb-2">No food available right now.</p>
                        <p class="text-lg">Please check back later or explore our other categories.</p>
                      </div>';
            }
            ?>
        </div>
        <div class="text-center mt-8">
            <a href="<?php echo SITEURL; ?>food.php" class="btn inline-block px-6 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-700 transition-all">More Food</a>
        </div>
    </div>
</section>


    <?php include('front-parts/footer1.php'); ?>
</body>

</html>
