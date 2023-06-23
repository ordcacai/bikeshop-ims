<?php
    include('layouts/header.php');
    include('server/connection.php');

    // Check if the compareList cookie is set
    if (!isset($_COOKIE['compareList'])) {
        echo "No products in the compare list.";
    } else {
        // Get the compare list from the cookie
        $compareList = json_decode($_COOKIE['compareList'], true) ?? [];

        // Fetch the details of the products in the compare list
        $products = [];
        foreach ($compareList as $productId) {
            $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
            if ($product) {
                $products[] = $product;
            } else {
                echo "No product found with ID: " . $productId;
            }
        }

        // Display the products if any are found
        if (empty($products)) {
            echo "No products found in the compare list.";
        } else {
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
<?php
        }
    }
    include('layouts/footer.php');
?>
