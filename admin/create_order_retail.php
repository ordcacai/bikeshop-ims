<?php
date_default_timezone_set('Asia/Singapore');
include('../server/connection.php');

    
        if(isset($_POST['add_order'])){

        //1. get user info and store in database
        $order_type = $_POST['order_type'];
        //$wsname = $_POST['wsname'];
        //$wsphone = $_POST['wsphone'];
        //$wsaddress = $_POST['wsaddress'];
        //$wscourier = $_POST['wscourier'];
        $order_status = $_POST['order_status'];
        $user_name = $_POST['name'];
        $user_phone = $_POST['phone'];
        $user_address = $_POST['address'];
        $user_landmark = $_POST['landmark'];
        $location_link = $_POST['location'];
        $shipping_method = $_POST['shipping_method'];
        $payment_method = $_POST['payment_method'];
        $remarks = $_POST['remarks'];
        //$order_cost = $_SESSION['total'];
        $user_id = $_SESSION['user_id'];
        $order_date = date('Y-m-d');

        // $payment_image = $_FILES['payment']['tmp_name'];

        // $payment_image_name = $order_date."1.jpeg";

        // move_uploaded_file($payment_image,"../assets/imgs/".$payment_image_name);
    
        $stmt = $conn->prepare("INSERT INTO orders (order_type, order_status, user_name, user_phone, user_address
        , user_landmark, location_link,shipping_method,payment_method,remarks,order_date) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
    
        $stmt->bind_param('sssisssssss',$order_type,$order_status,$user_name,$user_phone,$user_address,$user_landmark,$location_link,
        $shipping_method,$payment_method,$remarks,$order_date);
    
        $stmt_status = $stmt->execute();
    
        if(!$stmt_status){ 
        
            header('location: retail.php');
            exit;
    
        }else{
    

        $order_id = $stmt->insert_id;
            
        for($i=0; $i<count($_POST['row']); $i++){
            $product_name = $_POST['options'][$i];
            $product_color = $_POST['Color'][$i];
            $product_price = $_POST['Price'][$i];
            $product_quantity = $_POST['Quantity'][$i];

                if($order_id !== '' && $product_name !== '' && $product_color !== '' && $product_price !== '' && $product_quantity !== ''){

                    $query = $conn->prepare('INSERT INTO order_items (order_id, product_name, product_color, product_price, product_quantity ) VALUES (?, ?, ?, ?, ?)');
                    $query->bind_param('issii', $order_id, $product_name, $product_color, $product_price, $product_quantity );
                    $query->execute();
            
                }else{
            
                    echo '<div class="alert alert-danger" role="alert">Error Submitting in Data</div>';
            
                }

            }

            header('location: orders.php?order_created=Order placed successfully!');
        }
    }
?>  