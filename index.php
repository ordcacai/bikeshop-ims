<?php

    include('layouts/header.php');

?>   
    
    <!-- Home -->
<section>
      <section id="home">
        <div class="container">
            <h5>NEW ARRIVAL</h5>
            <h1>Electric E-bike Code 113</h1>
            <p>All new budget e-bike! For only Php 16,200</p>
            <button onclick="window.location.href='shop.php';">Shop Now</button>
        </div>
      </section>

      <!-- Banner -->

      <section id="banner" class="my-5 py-5">
        <div class="container">
            <h1 class="mb-4">EXTENDED LABOR DAY SALE!</h1>
            <h4>On all E-bikes, Bicycles, Parts and Accessories!</h4>
            <button onclick="window.location.href='shop.php';" class="text-uppercase">Shop Now</button>
        </div>
      </section>

      <!-- Brand -->

      <section id="brand" class="container">
        <div class="container text-center mt-5 py-5">
            <h3>Brands</h3>
            <hr class="mx-auto">
            <p>A lot of brands to choose from!</p>
        </div>
        <div class="row">
            <img src="assets/imgs/mtp_logo.png" class="img-fluid col-lg-3 col-md-6 col-sm-12">
            <img src="assets/imgs/giant.png" class="img-fluid col-lg-3 col-md-6 col-sm-12">
            <img src="assets/imgs/specialized_logo.png" class="img-fluid col-lg-3 col-md-6 col-sm-12">
            <img src="assets/imgs/foxter_logo.png" class="img-fluid col-lg-3 col-md-6 col-sm-12">
        </div>
      </section>

      <!-- New Product -->

      <section id="new" class="w-100">
        <div class="container text-center mt-5 py-5">
            <h3>New Products</h3>
            <hr class="mx-auto">
            <p>Only with the best quality bikes of all time.</p>
        </div>
        <div class="row p-0 m-0 container-fluid">

            <!-- 1st Product -->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img src="assets/imgs/new_bike4.jpg" class="img-fluid">
                <div class="details">
                    <h2>E-Bike</h2>
                    <button onclick="window.location.href='shop.php';" class="text-uppercase">Shop Now</button>
                </div>
            </div>
            <!-- 2nd Product -->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img src="assets/imgs/new_bike5.jpg" class="img-fluid">
                <div class="details">
                    <h2>Bike</h2>
                    <button onclick="window.location.href='shop.php';" class="text-uppercase">Shop Now</button>
                </div>
            </div>
            <!-- 3rd Product -->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img src="assets/imgs/Shimano Deore M4100 Shifters1.jpeg" class="img-fluid">
                <div class="details">
                    <h2>Parts</h2>
                    <button onclick="window.location.href='shop.php';" class="text-uppercase">Shop Now</button>
                </div>
            </div>
        </div>
      </section>

      <!-- Featured Product -->
      <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Featured Products</h3>
            <hr class="mx-auto">
            <p>Our best sellers are still available! Get yours now!</p>
        </div>
        <div class="row mx-auto container">

            <!-- 1st Featured -->

            <?php include('server/get_featured_products.php');?>

            <?php while($row = $featured_products->fetch_assoc()){?>

            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="assets/imgs/<?php echo $row['product_image'];?>" class="img-fluid mb-3">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name"><?php echo $row['product_name'];?></h5>
                <h4 class="p-price">₱<?php echo number_format($row['product_price'],2); ?></h4>
                <a href="<?php echo "product_view.php?product_id=".$row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
                
            </div>

            <?php } ?>
        </div>
      </section>

      <!-- Parts & Accessories -->
      <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Parts & Accessories</h3>
            <hr class="mx-auto">
            <p>For your upgrades and maintainance, we got you!</p>
        </div>
        <div class="row mx-auto container">

            <!-- 1st Parts & Accessories -->

            <?php include('server/get_parts.php');?>

            <?php while($row = $parts_products->fetch_assoc()){?>

            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="assets/imgs/<?php echo $row['product_image'];?>" class="img-fluid mb-3">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name"><?php echo $row['product_name'];?></h5>
                <h4 class="p-price">₱<?php echo number_format($row['product_price'],2);?></h4>
                <a href="<?php echo "product_view.php?product_id=".$row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
                
            </div>

            <?php } ?>

        </div>
      </section>
      </section>
<?php

include('layouts/footer.php');

?>  