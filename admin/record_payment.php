<?php
include('../server/connection.php');

if (isset($_POST['record_payment'])) {
    $cust_name = $_POST['name'];
    $amount = $_POST['amount'];
    $pay_date = $_POST['payment_date'];
    $ref_num = $_POST['ref_num'];
    $mop = $_POST['mop'];
    $notes = $_POST['notes'];
    $order_id = $_POST['order_id'];

    $image = $_FILES['image']['tmp_name']; // Uploaded file
    $image_name = $order_id . "_payment.jpeg"; // Image name
    move_uploaded_file($image, "../assets/imgs/" . $image_name); // Upload image

    // Record Payment
    $stmt = $conn->prepare("INSERT INTO payments (cust_name, amount, pay_date, ref_num, mop, notes, order_id, image_name) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param('sdssssis', $cust_name, $amount, $pay_date, $ref_num, $mop, $notes, $order_id, $image_name);


    // Execute the statement and handle errors
    if ($stmt->execute()) {
        header('location: invoice.php?payment_recorded=Payment recorded successfully!');
        exit;
    } else {
        header('location: invoice.php?payment_recordedFailed=Error occurred, please try again.');
        exit;
    }
}

?>
