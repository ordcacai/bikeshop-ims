<?php
include('../server/connection.php');

if (isset($_POST['payment'])) {
    $cust_name = $POST['name'];
    $order_id = $POST['order_id'];
    $amount = $POST['amount'];
   // $date = $POST['payment_date'];
    $ref_num = $POST['ref_num'];
    $mop = $POST['mop'];
    $notes = $POST['notes'];
    
    $image = $_FILES['image']['tmp_name']; // Upload file
    $image = $order_id . "1.jpeg"; // Image name
    move_uploaded_file($image, "../assets/imgs/" . $image_name1); // Upload image

    // Record Payment
    $stmt = $conn->prepare("INSERT INTO payments (product_name, product_category, product_description, product_image, product_image2, product_image3, product_image4,        product_price, product_bp, product_wsp, product_special_offer) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

    $stmt->bind_param('sssssssdddd', $product_name, $product_category, $product_description, $image_name1,
    $image_name2, $image_name3, $image_name4, $retail_price, $base_price, $ws_price, $product_special_offer);

    if ($stmt->execute()) {

        $product_id = $stmt->insert_id;

        for($i=0; $i<count($_POST['row']); $i++){
        $product_name = $_POST['name'];
        $color_size = $_POST['color_size'][$i];
        $quantity = $_POST['quantity'][$i];
 
    
    
    if($product_id !== '' && $product_name !== '' && $color_size !== '' && $quantity !== ''){

        $query = $conn->prepare('INSERT INTO stocks (product_id, product_name, quantity, color_size) VALUES (?, ?, ?, ?)');
        $query->bind_param('isis', $product_id, $product_name, $quantity, $color_size);
        $query->execute();

    }else{

        echo '<div class="alert alert-danger" role="alert">Error Submitting in Data</div>';

    }
}


        header('location: inventory.php?product_added=Product has been created successfully!');
        exit;
    } else {
        header('location: inventory.php?product_failed=Error occurred, please try again.');
        exit;
    }
}

?>
