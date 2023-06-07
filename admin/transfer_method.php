<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $product_name = $_POST["product-name"];
    $location_from = $_POST["location_from"];
    $location_to = $_POST["location_to"];
    $quantity = $_POST["quantity"];
    $color_size = $_POST["color-size"];
    $transfer_date = $_POST["transfer_date"];

    // Perform validation
    $errors = array();

    // Check if the product name corresponds to the correct product ID
    $sql = "SELECT product_id, product_name FROM products WHERE product_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $product_id, $product_name);
    $stmt->execute();
    $stmt->get_result();


    if (!$product_id) {
        $errors[] = "Invalid product name.";
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

    // Update the quantity in location_to
    $sql_update_to = "UPDATE stocks SET quantity = quantity + ? WHERE location_to = ? AND product_id = ?";
    $stmt_update_to = $conn->prepare($sql_update_to);
    $stmt_update_to->bind_param("isi", $quantity, $location_to, $product_id);
    $stmt_update_to->execute();
    $stmt_update_to->close();

    // Subtract the quantity from location_from
    $sql_update_from = "UPDATE stocks SET quantity = quantity - ? WHERE location_from = ? AND product_id = ?";
    $stmt_update_from = $conn->prepare($sql_update_from);
    $stmt_update_from->bind_param("isi", $quantity, $location_from, $product_id);
    $stmt_update_from->execute();
    $stmt_update_from->close();

    $stmt = $conn->prepare("INSERT INTO stock_transfer (product_id, product_name, location_from, location_to, quantity, color_size, transfer_date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('isssiss', $product_id, $product_name, $location_from, $location_to, $quantity, $color_size, $transfer_date);
    
    if ($stmt->execute()) {
        echo "Stock transfer recorded successfully.";
    } else {
        echo "Error recording stock transfer: " . $stmt->error;
    }
    
}
?>