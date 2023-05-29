<?php include('header.php'); ?>
<?php
    
    if(!isset($_SESSION['admin_logged_in'])){
        header('location: login.php');
        exit;

    }else{
        
        if(isset($_POST['add_order'])){

        //1. get user info and store in database
        $user_name = $_POST['name'];
        $user_phone = $_POST['phone'];
        $user_address = $_POST['address'];
        $user_landmark = $_POST['landmark'];
        $location_link = $_POST['location'];
        $payment_method = $_POST['payment_method'];
        $shipping_method = $_POST['shipping_method'];
        $order_cost = $_SESSION['total'];
        $order_status = ['order_status'];
        $user_id = $_SESSION['user_id'];
        $order_date = date('Y-m-d H:i:s');

        // $payment_image = $_FILES['payment']['tmp_name'];

        // $payment_image_name = $order_date."1.jpeg";

        // move_uploaded_file($payment_image,"../assets/imgs/".$payment_image_name);
    
        $stmt = $conn->prepare("INSERT INTO orders (order_status, user_name, user_id, user_phone, user_address, user_landmark, location_link, payment_method, shipping_method, order_date) VALUES (?,?,?,?,?,?,?,?,?,?); ");
    
        $stmt->bind_param('ssiissssss', $order_status, $user_name, $user_id, $user_phone, $user_address, $user_landmark, $location_link, $payment_method, $shipping_method, $order_date);
    
        $stmt_status = $stmt->execute();
    
        if(!$stmt_status){
    
            header('location: retail.php');
            exit;
    
        }

        $order_id = $stmt->insert_id;

        header('location: orders.php?order_created=Order placed successfully');

    }
}

?>