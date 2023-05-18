<?php include('header.php'); ?>

<?php
    // Check if product_id is provided in the URL
    if (!isset($_GET['product_id'])) {
        header('location: inventory.php');
        exit;
    }

    // Retrieve the product details from the database based on the provided product_id
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
?>

<?php include('sidemenu.php'); ?>

<link rel="stylesheet" type="text/css" href="admin_style.css">

<div class="main-content">
    <div class="container-fluid">
        <h1 class="my-4">Product Details</h1>

        <div class="product-details-container">
            <div class="product-image">
                <img src="<?php echo "../assets/imgs/".$product['product_image']; ?>" alt="Product Image" class="img-fluid">
            </div>
            <div class="product-info">
                <div class="product-details">
                    <h2><?php echo $product['product_name']; ?></h2>
                    <div class="product-info-box">
                        <p class="product-price">SRP: <?php echo $product['product_price']; ?></p>
                        <p class="product-price">WSP: <?php echo $product['product_special_offer']; ?></p>
                        <p class="product-quantity">QTY: <?php echo $product['product_quantity']; ?></p>
                        <p class="product-quantity">Stocks: <?php echo $product['product_quantity']; ?></p>
                    </div>
                </div>
                <div class="specifications-box">
                    <h2>Specifications</h2>
                    <p><?php echo $product['product_description']; ?></p>
                    <p>Color: <?php echo $product['product_color']; ?></p>
                </div>
                <div class="buttons-container">
                    <a href="edit_product.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-primary">Edit</a>
                    <a href="inventory.php" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>


