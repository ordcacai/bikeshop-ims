<?php

    include('layouts/header.php');

?> 

<?php

include('server/connection.php');

if(isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);

    $stmt->execute();

    $product = $stmt->get_result(); //<- Array

    $stmt5 = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt5->bind_param("i", $product_id);

    $stmt5->execute();
    $products = $stmt5->get_result(); //<- Array

    $stmt3 = $conn->prepare("SELECT quantity, color_size FROM stocks WHERE product_id = ?");
    $stmt3->bind_param("i", $product_id);

    $stmt3->execute();

    $stock = $stmt3->get_result(); //<- Array

    $stmt1 = $conn->prepare("SELECT * FROM products WHERE product_category = 'Bike' LIMIT 4");
    $stmt1->execute();
    $bike = $stmt1->get_result(); //<- Array

    $stmt1 = $conn->prepare("SELECT * FROM products WHERE product_category = 'parts' LIMIT 4");
    $stmt1->execute();
    $parts = $stmt1->get_result(); //<- Array

    $stmt1 = $conn->prepare("SELECT * FROM products WHERE product_category = 'Ebike' LIMIT 4");
    $stmt1->execute();
    $ebike = $stmt1->get_result(); //<- Array

    $query = $conn->prepare('SELECT quantity FROM stocks WHERE product_id = ?');
    $query->bind_param('i', $product_id);
    $quantity = $query->get_result();


    //no product_id given
}else{
    header('location: index.php');
}

?>

    <!-- Product View -->

    <section class=" container product-view my-5 pt-5">
        <div class="row mt-5">

            <?php while($row = $product->fetch_assoc()){ ?>

            <div class="col-lg-5 col-md-6 col-sm-12">
                <img src="assets/imgs/<?php echo $row['product_image']; ?>" class="img-fluid w-100 pb-1" id="mainImg" alt="">
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image']; ?>" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image2']; ?>" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image3']; ?>" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image4']; ?>" width="100%" class="small-img" alt="">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 mx-5">
                <h6><?php echo $row['product_category']; ?></h6>
                <h3 class="pb-2"><?php echo $row['product_name']; ?></h3>
                <h2 class="pb-2 pt-2">₱<?php echo $row['product_price']; ?></h2>
                    
                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                    <?php }?>
                    <select class="form-select mb-4" required name="product_color" required>
                        <option value="">Select a Color</option>
                        <?php foreach($stock as $row){?>
                        <option value="<?php echo $row['color_size'];?>"><?php echo $row['color_size'];?></option>
                        <?php }?>
                    </select>
                    <?php while($row = $products->fetch_assoc()){ ?>
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
                    <input type="number" name="product_quantity" value="1" min="1" max="<?php echo $quantity ?>">
                    <button class="buy-btn mb-4" type="submit" name="add_to_cart">Add to Cart</button>
                </form>

                <h4 class="mt-5 mb-3">Product Details</h4>
                <span><?php echo $row['product_description']; ?></span>

                <?php if ($row['product_category'] === 'Bike') { ?>
                    <h4 class="mt-5 mb-3">Warranty Information</h4>
                    <span><i class="bi bi-exclamation-triangle"></i> 7 Days Warranty for parts.<br></span>
                    <span><i class="bi bi-exclamation-triangle"></i> 1 Month free tuning and adjustment.<br></span>
                <?php } elseif ($row['product_category'] === 'parts') { ?>
                    <h4 class="mt-5 mb-3">Warranty Information</h4>
                    <span><i class="bi bi-exclamation-triangle"></i> Warranty is for defective items only. You must check the product upon purchase.<br></span>
                <?php } elseif ($row['product_category'] === 'Ebike') { ?>
                    <h4 class="mt-5 mb-3">Warranty Information</h4>
                    <span><i class="bi bi-exclamation-triangle"></i> 7 Days Parts Replacement (controller, motor, charger)<br></span>
                    <span><i class="bi bi-exclamation-triangle"></i> 3 MONTHS WARRANTY FOR BATTERY. Other parts not included.<br></span>
                    <span><i class="bi bi-exclamation-triangle"></i> 1 MONTH FREE SERVICE WARRANTY </span>
                <?php } ?>

            </div>
             
        </div>
    </section>

    <!-- Related Product -->
    <section id="related-products" class="my-5 py-5">
        <div class="container text-center mt-5 py-5">
            <h3>Related Products</h3>
            <hr class="mx-auto">
        </div>

        <div class="row mx-auto container">

        <?php if($row['product_category'] == 'Bike'){ ?>

            <?php while($row = $bike->fetch_assoc()){ ?>

                    <!-- 1st Related -->
                    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                        <img src="assets/imgs/<?php echo $row['product_image']; ?>" class="img-fluid mb-3" href="<?php echo "product_view.php?product_id=".$row['product_id']; ?>">
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                        <h4 class="p-price">₱<?php echo $row['product_price']; ?></h4>
                        <button class="buy-btn" href="<?php echo "product_view.php?product_id=".$row['product_id']; ?>">Buy Now</button>
                        
                    </div>

                <?php } ?>

            <?php }else if($row['product_category'] == 'parts'){ ?>

                <?php while($row = $parts->fetch_assoc()){ ?>
                    <!-- 1st Related -->
                    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                        <img src="assets/imgs/<?php echo $row['product_image']; ?>" class="img-fluid mb-3">
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                        <h4 class="p-price">₱<?php echo $row['product_price']; ?></h4>
                        <button class="buy-btn" href="<?php echo "product_view.php?product_id=".$row['product_id']; ?>">Buy Now</button>
                        
                    </div>

                <?php } ?>

            <?php }else{ ?>

                <?php while($row = $ebike->fetch_assoc()){ ?>
                    <!-- 1st Related -->
                    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                        <img src="assets/imgs/<?php echo $row['product_image']; ?>" class="img-fluid mb-3">
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                        <h4 class="p-price">₱<?php echo $row['product_price']; ?></h4>
                        <button class="buy-btn" href="<?php echo "product_view.php?product_id=".$row['product_id']; ?>">Buy Now</button>
                        
                    </div>

                <?php } ?>

            <?php } ?>
            
        <?php } ?>

        </div>

    </section>
<script>

    var mainImg = document.getElementById("mainImg");
    var smallImg = document.getElementsByClassName("small-img");

    for(let i=0; i<4; i++){
            smallImg[i].onclick = function(){
            mainImg.src = smallImg[i].src
        }
    }
        
</script>

<?php include('layouts/footer.php'); ?>