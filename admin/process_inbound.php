<?php
date_default_timezone_set('Asia/Singapore');
include('../server/connection.php');

    
        if(isset($_POST['record-transfer'])){

        //1. get user info and store in database
        $location_from = $_POST['location_from'];
        $location_to = $_POST['location_to'];
        $transfer_date = $_POST['transfer_date'];
        $transfer_type = $_POST['transfer_type'];
        $supplier_name = $_POST['supplier_name'];
        $reference_no = $_POST['reference_no'];
            
        for($i=0; $i<count($_POST['row']); $i++){
            $product_id = $_POST['options'][$i];
            $product_quantity = $_POST['Quantity'][$i];

            $stmt = $conn->prepare('SELECT product_name, color_size FROM stocks WHERE product_id = ?');
            $stmt->bind_param('i', $product_id);
            $stmt->execute();
            $stock = $stmt->get_result();

            foreach($stock as $row){
            $product_name = $row['product_name'];
            $color_size = $row['color_size'];
            }
                if($product_id !== '' && $product_quantity !== '' && $product_name !== '' && $color_size !== ''){

                    $query = $conn->prepare('INSERT INTO stock_transfer (product_id, product_name, location_from, location_to, supplier_name, reference_number, quantity, color_size, transfer_date, transfer_type ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                    $query->bind_param('isssssisss', $product_id, $product_name, $location_from, $location_to, $supplier_name, $reference_no, $product_quantity, $color_size, $transfer_date, $transfer_type );
                    $query->execute();

                    $stmt1 = $conn->prepare('SELECT quantity FROM stocks WHERE product_id = ? AND color_size = ?');
                    $stmt1->bind_param('is', $product_id, $color_size);
                    $stmt1->execute();
                    $products = $stmt1->get_result();

                    foreach($products as $product){

                    $new_quantity = $product['quantity'] + $product_quantity;

                    $stmt2 = $conn->prepare('UPDATE stocks SET quantity = ? WHERE product_id = ? AND color_size = ?');
                    $stmt2->bind_param('iis', $new_quantity, $product_id, $color_size);
                    $stmt2->execute();
                    }
            
                }else{
            
                    echo '<div class="alert alert-danger" role="alert">Error Submitting in Data</div>';
            
                }

            }

            header('location: report_stocks.php?inbound_created=Inbound added successfully!');
        }
?>  