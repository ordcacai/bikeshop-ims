<?php

    include('layouts/header.php');

?> 

<?php

include('server/connection.php');

//use the search section
if(isset($_POST['search'])){

    //1. determine page no.
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        //if user has already entered page then page number is the one that they selected
        $_page_no = $_GET['page_no'];
    }else{
        //if user just entered the page then default page is 1
        $page_no = 1;
    }

    $category = $_POST['category'];
    // $price = $_POST['price'];

    //2. return number of products
    $stmt = $conn->prepare("SELECT COUNT(*) As total_records FROM products WHERE product_category=?");
    $stmt->bind_param('s', $category);
    $stmt->execute();
    $stmt->bind_result($total_records);
    $stmt->store_result();
    $stmt->fetch();

    //3. products per page
    $total_records_per_page = 4;
    $offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";
    $total_no_of_pages = ceil($total_records/$total_records_per_page);

    //4. get all products
    $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category=? LIMIT $offset, $total_records_per_page");
    $stmt2->bind_param("s", $category);
    $stmt2->execute();
    $products = $stmt2->get_result();//array

//return all products
}else{

    //1. determine page no.
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        //if user has already entered page then page number is the one that they selected
        $page_no = $_GET['page_no'];
    }else{
        //if user just entered the page then default page is 1
        $page_no = 1;
    }

    //2. return number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products");
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    //3. products per page
    $total_records_per_page = 4;
    $offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";
    $total_no_of_pages = ceil($total_records/$total_records_per_page);

    //4. get all products
    $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset, $total_records_per_page");
    $stmt2->execute();
    $products = $stmt2->get_result();//array
}

?>

<!-- Search -->
<div id="shop-container">
<section id="search" class="my-5 py-5"> 
        <div class="container mt-5 py-5">
            <h4 class="text-center">Search Products</h4>
            <hr>
        

            <form action="shop.php" method="POST">
                <div class="row mx-auto container">
                    <div class="col-lg-12 col-md-12 col-sm-12">
        
                        <p>Category</p>
                        
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="category_one" value="Bike" type="radio" name="category" <?php if(isset($category) && $category == 'Bike'){echo 'checked';} ?>>
                            <label for="flexRadioDefault2" class="form-check-label">Bike</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="category_one" value="EBike" type="radio" name="category" <?php if(isset($category) && $category == 'EBike'){echo 'checked';} ?>>
                            <label for="flexRadioDefault2" class="form-check-label">E-Bike</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="category_two" value="parts" type="radio" name="category" <?php if(isset($category) && $category == 'parts'){echo 'checked';} ?>>
                            <label for="flexRadioDefault2" class="form-check-label">Parts</label>
                        </div>

                    </div>

                    <!-- <div class="row mx-auto container mt-5">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <p>Price</p>
                            <input type="range" class="form-range w-50" name="price" value="<?php if(isset($price)){echo $price;}else{echo "100";} ?>" min="1000"  max="50000"id="customRange2">
                            <div class="w-50">
                                <span style="float: left;">₱1,000</span>
                                <span style="float: right;">₱50,000</span>
                            </div>

                        </div>
                    </div> -->
                </div>

                <div class="form-group my-3 mx-3">
                    <input type="submit" name="search" value="Search" class="btn btn-primary">
                </div>
            </form>
        </div>
    </section>

    <!-- Shop -->
    <section id="shop" class="my-5 py-5">
        <div class="container text-center mt-5 py-5">
            <h3>Our Products</h3>
            <hr class="mx-auto">
        </div>
        <div class="row mx-auto container">

        <!-- Products -->

        <?php while($row = $products->fetch_assoc()) { ?>

            <div onclick="window.location.href='product_view.php';" class="product text-center col-lg-3 col-md-4 col-sm-12">
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
                <a class="btn buy-btn" href="<?php echo "product_view.php?product_id=".$row['product_id']; ?>">Buy Now</a>       
            </div>

        <?php } ?>
 
            <nav aria-label="Page navigation example" class="text-center">
                <ul class="pagination mt-5 justify-content-center">
                    <li class="page-item">
                        <a class="page-link <?= ($page_no <= 1) ? 'disabled' : ''; ?> " <?= ($page_no > 1) ? 'href=?page_no=' .$previous_page : ''; ?>>Previous</a>
                    </li>


                    <li class="page-item"><a href="?page_no=1" class="page-link">1</a></li>
                    <li class="page-item"><a href="?page_no=2" class="page-link">2</a></li>

                        <?php if($page_no >= 3) { ?>
                            <li class="page-item"><a href="#" class="page-link">...</a></li>
                            <li class="page-item"><a href="?page_no=<?= $page_no; ?>" class="page-link"><?= $page_no; ?></a></li>
                        <?php } ?>

                    <li class="page-item">
                        <a class="page-link <?= ($page_no >= $total_no_of_pages) ? 'disabled' : ''; ?> " <?= ($page_no < $total_no_of_pages) ? 'href=?page_no=' .$next_page : ''; ?>>Next</a>
                    </li>

                </ul>
            </nav>

            <div class="p-10">
                <strong>Page <?= $page_no; ?> of <?= $total_no_of_pages ?></strong>
            </div>

        </div>
    </section>
</div>
<?php include('layouts/footer.php'); ?>