<?php 

session_start(); 
include('../server/connection.php');

?>
<?php

    if(!isset($_SESSION['logged_in'])){
        header('location: ../login.php');
        exit;
    }

    if(isset($_GET['order_id'])){
        $order_id = $_GET['order_id'];
        $stmt = $conn->prepare("DELETE orders, order_items FROM orders INNER JOIN order_items WHERE orders.order_id= order_items.order_id AND orders.order_id=?");
        $stmt->bind_param('i', $order_id);
        
        if($stmt->execute()){

            header('location: orders.php?delete_success_message=Order has been deleted successfully!');

        }else{

            header('location: orders.php?delete_failure_message=Order could not be deleted.');
            
        }

        
    }
?>
