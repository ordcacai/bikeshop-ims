<?php 

session_start(); 
include('../server/connection.php');
include('security.php');
?>
<?php

    if(!isset($_SESSION['logged_in'])){
        header('location: ../login.php');
        exit;
    }

    if(isset($_GET['product_id'])){
        $product_id = $_GET['product_id'];
        $stmt = $conn->prepare("DELETE FROM products WHERE product_id=?");
        $stmt->bind_param('i', $product_id);
        
        if($stmt->execute()){

            header('location: inventory.php?delete_success_message=Product has been deleted successfully!');

        }else{

            header('location: inventory.php?delete_failure_message=Product could not be deleted.');
            
        }

        
    }
?>
