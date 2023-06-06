<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $product_name = $_POST["name"];
    $location_from = $_POST["location_from"];
    $location_to = $_POST["location_to"];
    $quantity = $_POST["quantity"];
    $color_size = $_POST["color_size"];
    $transfer_date = $_POST["transfer_date"];

    $stmt = $conn->prepare("INSERT INTO stock_transfer (product_name, location_from, location_to, quantity, color_size, transfer_date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssiss', $product_name, $location_from, $location_to, $quantity, $color_size, $transfer_date);
    $stmt->execute();
    
}
?>