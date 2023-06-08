<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $product_id = $_POST['product_name'];
    $location_from = $_POST["location_from"];
    $location_to = $_POST["location_to"];
    $quantity = $_POST["quantity"];
    $color_size = $_POST["color-size"];
    $transfer_date = $_POST["transfer_date"];

    // Perform validation
    $errors = array();

    // Check if the product ID is empty or not a positive integer
    if (empty($product_id) || !ctype_digit($product_id) || $product_id <= 0) {
        $errors[] = "Invalid product ID.";
    }

    // Check if the product name matches the selected product ID
    $stmt = $conn->prepare("SELECT product_name FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        $errors[] = "Invalid product ID.";
    } else {
        $product_name = $product['product_name'];
    }

    // Check if quantity is a positive integer
    if (!ctype_digit($quantity) || $quantity <= 0) {
        $errors[] = "Quantity must be a positive integer.";
    }

    // Check if color-size is not empty
    if (empty($color_size)) {
        $errors[] = "Color & Size cannot be empty.";
    }

    // Check if there are any errors
    if (!empty($errors)) {
        // Display error messages
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        // Terminate the script or redirect back to the form page
        exit();
    }

    // Update the quantity in stock_transfer table (location_to)
    $sql_update_to = "UPDATE stock_transfer SET quantity = quantity + ? WHERE location_to = ? AND product_id = ?";
    $stmt_update_to = $conn->prepare($sql_update_to);
    $stmt_update_to->bind_param("isi", $quantity, $location_to, $product_id);
    $stmt_update_to->execute();
    $stmt_update_to->close();

    // Subtract the quantity from stock_transfer table (location_from)
    $sql_update_from = "UPDATE stock_transfer SET quantity = quantity - ? WHERE location_from = ? AND product_id = ?";
    $stmt_update_from = $conn->prepare($sql_update_from);
    $stmt_update_from->bind_param("isi", $quantity, $location_from, $product_id);
    $stmt_update_from->execute();
    $stmt_update_from->close();

    $stmt = $conn->prepare("INSERT INTO stock_transfer (product_id, product_name, location_from, location_to, quantity, color_size, transfer_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('isssiss', $product_id, $product_name, $location_from, $location_to, $quantity, $color_size, $transfer_date);
    
    if ($stmt->execute()) {
        echo "Stock transfer recorded successfully.";
    } else {
        echo "Error recording stock transfer: " . $stmt->error;
    }
    
}
?>
