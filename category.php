<?php include('front-parts/home.php');
      include('front-parts/user-authorization.php'); 
 ?>
<link rel="stylesheet" href="home.css">
<section class="category">
    <div class="category-content">
        <h2>Food Categories</h2>
        <br>
        
        <div class="image-row">
            <?php
                $sql = "SELECT * FROM category_table WHERE active='Yes'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) 
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="box">
                            <!-- Wrap image and title in an anchor tag -->
                            <a href="<?php echo SITEURL; ?>category-food.php?category_id=<?php echo $id; ?>">
                                <img src="<?php echo SITEURL; ?>photos/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>">
                                <h3><?php echo $title; ?></h3>
                            </a>
                        </div>
                        <?php
                    }
                } 
                else 
                {
                    // Handle case where no categories are found
                    echo '<div class="w-full text-center p-6 bg-gray-200 rounded-lg shadow-lg">
                            <p class="text-2xl font-bold mb-2">No categories available right now.</p>
                            <p class="text-lg">Please check back later for more options.</p>
                          </div>';
                }
            ?>
        </div>
    </div>
</section>

<?php include('front-parts/footer1.php'); ?>