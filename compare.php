<?php
include('layouts/header.php');
?>

<?php
include('server/connection.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);

    $stmt->execute();

    $product = $stmt->get_result(); //<- Array

    $stmt1 = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt1->bind_param("i", $product_id);

    $stmt1->execute();
    $product2 = $stmt1->get_result(); //<- Array
} else {
    header('location: index.php');
}

?>

<!-- Compare Products -->
<section class="container compare-products my-5">
    <div class="row mt-5">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <?php while ($row = $product->fetch_assoc()) { ?>
                <h6><?php echo $row['product_brand']; ?></h6>
                <h2><?php echo $row['product_name']; ?></h2>
                <h3>$<?php echo $row['product_price']; ?></h3>
                <div class="product-rating">
                    <?php for ($i = 0; $i < $row['product_rating']; $i++) { ?>
                        <i class="fas fa-star"></i>
                    <?php } ?>
                    <?php for ($i = 0; $i < 5 - $row['product_rating']; $i++) { ?>
                        <i class="far fa-star"></i>
                    <?php } ?>
                </div>
                <p><?php echo $row['product_description']; ?></p>
            <?php } ?>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">
            <?php while ($row = $product2->fetch_assoc()) { ?>
                <h6><?php echo $row['product_brand']; ?></h6>
                <h2><?php echo $row['product_name']; ?></h2>
                <h3>$<?php echo $row['product_price']; ?></h3>
                <div class="product-rating">
                    <?php for ($i = 0; $i < $row['product_rating']; $i++) { ?>
                        <i class="fas fa-star"></i>
                    <?php } ?>
                    <?php for ($i = 0; $i < 5 - $row['product_rating']; $i++) { ?>
                        <i class="far fa-star"></i>
                    <?php } ?>
                </div>
                <p><?php echo $row['product_description']; ?></p>
            <?php } ?>
        </div>
    </div>
</section>
<!-- End Compare Products -->

<?php
include('layouts/footer.php');
?>
