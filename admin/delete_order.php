<?php

session_start();
include('../server/connection.php');
include('security.php');

if (!isset($_SESSION['logged_in'])) {
    header('location: ../login.php');
    exit;
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Delete payment record from the "payments" table
    $delete_stmt = $conn->prepare("DELETE FROM payments WHERE order_id = ?");
    $delete_stmt->bind_param('i', $order_id);
    
    if ($delete_stmt->execute()) {
        // Delete order and order_items records from the "orders" and "order_items" tables
        $delete_order_stmt = $conn->prepare("DELETE orders, order_items FROM orders INNER JOIN order_items WHERE orders.order_id = order_items.order_id AND orders.order_id = ?");
        $delete_order_stmt->bind_param('i', $order_id);

        if ($delete_order_stmt->execute()) {
            header('location: orders.php?delete_success_message=Order and payment record have been deleted successfully!');
        } else {
            header('location: orders.php?delete_failure_message=Failed to delete order and payment record.');
        }
    } else {
        header('location: orders.php?delete_failure_message=Failed to delete payment record.');
    }
}

?>
