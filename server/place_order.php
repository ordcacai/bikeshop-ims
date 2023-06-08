<?php

session_start();
include('connection.php');

//if user is not logged in
if(!isset($_SESSION['logged_in'])){

    header('location: ../checkout.php?message=Please login/register to place an order');
    exit;

//if user is logged in then proceed
}else{

    if(isset($_POST['place_order'])){

        //1. get user info and store in database
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $landmark = $_POST['landmark'];
        $location = $_POST['location'];
        $payment_method = $_POST['payment_method'];
        $shipping_method = $_POST['shipping_method'];
        $order_cost = $_SESSION['total'];
        $order_status = "Pending";
        $order_type = "retail";
        $user_id = $_SESSION['user_id'];
        $order_date = date('Y-m-d H:i:s');
    
        $stmt = $conn->prepare("INSERT INTO orders (order_type, order_cost, order_status, user_name, user_email, user_id, user_phone, user_city, user_address, user_landmark, location_link, payment_method, shipping_method, order_date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?); ");
    
        $stmt->bind_param('sisssiisssssss',$order_type, $order_cost, $order_status, $name, $email, $user_id, $phone, $city, $address, $landmark, $location, $payment_method, $shipping_method, $order_date);
    
        $stmt_status = $stmt->execute();
    
        if(!$stmt_status){
    
            header('location: index.php');
            exit;
    
        }
    
        //2. get new order and store order info in database
        $order_id = $stmt->insert_id;
    
        //3. get products from cart (from session)
    
        foreach($_SESSION['cart'] as $key => $value){//key value pair
    
            $product = $_SESSION['cart'][$key]; //return array
            $product_id = $product['product_id'];
            $product_name = $product['product_name'];
            $product_color = $product['product_color'];
            $product_image = $product['product_image'];
            $product_price = $product['product_price'];
            $product_quantity = $product['product_quantity'];
            
            
            //4. store each single item in database (order_items)
            $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_color, product_image, product_price, product_quantity, user_id, order_date)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
            $stmt1->bind_param('iisssiiis', $order_id, $product_id, $product_name, $product_color, $product_image, $product_price, $product_quantity, $user_id, $order_date);
    
            $stmt1->execute();
            
           
        }
        
        $_SESSION['order_id'] = $order_id;

        //5. remove everything from cart
        if(isset($_POST['place_order'])){

            unset($_SESSION['cart']);
            unset($_SESSION['order_id']);
            unset($_SESSION['quantity']);
            header('location: ../payment.php?id=payment');
            exit;
        }

        
        //6. inform user whether order is placed or not
        // header('location: ../payment.php?');
        
    }

}

?>