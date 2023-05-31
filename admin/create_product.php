<?php
include('../server/connection.php');

if (isset($_POST['add_product'])) {
    $product_name = $_POST['name'];
    $product_category = $_POST['category'];
    $product_description = $_POST['description'];
    $base_price = $_POST['base_price'];
    $retail_price = isset($_POST['retail_price']) ? $_POST['retail_price'] : 0; // Set a default value if price is not provided
    $ws_price = $_POST['ws_price'];
    $product_special_offer = $_POST['discount_price'];
    $product_color_size = isset($_POST['color_size']) ? $_POST['color_size'] : '';
    $product_quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';

    // Uploaded file
    $image1 = $_FILES['image1']['tmp_name'];
    $image2 = $_FILES['image2']['tmp_name'];
    $image3 = $_FILES['image3']['tmp_name'];
    $image4 = $_FILES['image4']['tmp_name'];

    // Image names
    $image_name1 = $product_name . "1.jpeg";
    $image_name2 = $product_name . "2.jpeg";
    $image_name3 = $product_name . "3.jpeg";
    $image_name4 = $product_name . "4.jpeg";

    // Upload images
    move_uploaded_file($image1, "../assets/imgs/" . $image_name1);
    move_uploaded_file($image2, "../assets/imgs/" . $image_name2);
    move_uploaded_file($image3, "../assets/imgs/" . $image_name3);
    move_uploaded_file($image4, "../assets/imgs/" . $image_name4);
    
    // Create new product
    $stmt = $conn->prepare("INSERT INTO products (product_name, product_category, product_description, product_image, product_image2, product_image3, product_image4,        product_price, product_bp, product_wsp, product_special_offer, product_color, product_quantity) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");

    $stmt->bind_param('sssssssddddsi', $product_name, $product_category, $product_description, $image_name1,
    $image_name2, $image_name3, $image_name4, $retail_price, $base_price, $ws_price, $product_special_offer, $product_color_size, $product_quantity);

    if ($stmt->execute()) {
        header('location: inventory.php?product_added=Product has been created successfully!');
        exit;
    } else {
        header('location: inventory.php?product_failed=Error occurred, please try again.');
        exit;
    }
}

?>
