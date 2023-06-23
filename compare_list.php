<?php
    include('layouts/header.php');
    include('server/connection.php');

    // Get the compare list from localStorage
    $compareList = json_decode($_COOKIE['compareList']) ?? [];

    // Fetch the details of the products in the compare list
    $products = [];
    foreach ($compareList as $productId) {
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $products[] = $product;
    }
?>

<section class="container compare-list my-5">
    <h2>Compare List</h2>
    <div class="row">
        <?php foreach ($products as $product) { ?>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="compare-item">
                    <img src="assets/imgs/<?php echo $product['product_image']; ?>" alt="Product Image">
                    <h4><?php echo $product['product_name']; ?></h4>
                    <ul>
                        <li>Specifications: <?php echo $product['product_description']; ?></li>
                        <!-- Add more specifications as needed -->
                    </ul>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<?php include('layouts/footer.php'); ?>
