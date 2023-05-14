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

<div class="main-content">
    <div class="container-fluid">
            <h1 class="mb-4">Product Details</h1>

            <div>
                <h2>Product Name: <?php echo $product['product_name']; ?></h2>
                <p>Stocks: <?php echo $product['product_quantity']; ?></p>

                <!-- Add Edit and Cancel buttons with appropriate URLs -->
                <a href="edit_product.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-primary">Edit</a>
                <a href="inventory.php" class="btn btn-secondary">Cancel</a>
            </div>
        </main>
    </div>
</div>
