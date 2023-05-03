<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category = 'parts' LIMIT 4");

$stmt->execute();

$parts_products = $stmt->get_result(); //<- Array
?>