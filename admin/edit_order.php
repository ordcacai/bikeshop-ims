<?php include('header.php'); ?>

<?php

if(isset($_GET['order_id'])){

    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id=?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $orders = $stmt->get_result();//array

}else if(isset($_POST['edit_order'])){

    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id = ?");
    $stmt->bind_param('si', $status, $order_id);
    $stmt->execute();

    if($stmt->execute()){

        if($status == 'delivered'){

            $stmt = $conn->prepare('SELECT * FROM order_items WHERE order_id = ?');
            $stmt->bind_param('i', $order_id);
            $stmt->execute();
            $order_items = $stmt->get_result();

            foreach($order_items as $row){
            $product_quantity = $row['product_quantity'];
            $product_id = $row['product_id'];
            $product_color = $row['product_color'];
            }

            $stmt1 = $conn->prepare('SELECT quantity FROM stocks WHERE product_id = ? AND color_size = ?');
            $stmt1->bind_param('is', $product_id, $product_color);
            $stmt1->execute();
            $products = $stmt1->get_result();

            foreach($products as $product){

            $new_quantity = $product['quantity'] - $product_quantity;

            $stmt2 = $conn->prepare('UPDATE stocks SET quantity = ? WHERE product_id = ? AND color_size = ?');
            $stmt2->bind_param('iis', $new_quantity, $product_id, $product_color);
            $stmt2->execute();
            }

        }

        header('location: orders.php?order_updated=Order has been updated successfully!');
        
    }else{

        header('location: orders.php?order_update_failed=Error occured, Please try again.');

    }

}else{
    header('location: orders.php');
    exit;
}




?>

<?php include('security.php');
include('sidemenu.php'); ?>

<div class="main-content">
    <div class="container-fluid">
            <h2 class="form-weight-bold my-3">Edit Order</h2>
            <div class="table-responsive">

                <div class="mx-auto container">

                    <form id="edit-form" method="POST" action="edit_order.php">
                        <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>

                        <?php foreach($orders as $order){ ?>

                        <input type="hidden" value="<?php echo $order['order_id']; ?>" name="order_id">
                        <div class="form-group my-3">
                            <label><strong>Order ID</strong></label>
                            <p class="my-4"><?php echo $order['order_id']; ?></p>
                        </div>
                        
                        <div class="form-group my-3">
                            <label><strong>Order Price</strong></label>
                            <p class="my-4"><?php echo number_format($order['order_cost'],2); ?></p>
                        </div>

                        <div class="form-group my-3">
                            <label><strong>Order Date</strong></label>
                            <p class="my-4"><?php echo $order['order_date']; ?></p>
                        </div>

                        <div class="form-group my-3">
                            <label><strong>Order Status</strong></label>
                            <select class="form-select" required name="status">
                            
                                <option value="Pending" <?php if($order['order_status'] == 'Pending'){echo "selected";} ?>>Pending</option>
                                <option value="Shipped" <?php if($order['order_status'] == 'Shipped'){echo "selected";} ?>>For Delivery/Ship out</option>
                                <option value="Delivered" <?php if($order['order_status'] == 'Delivered'){echo "selected";} ?>>Delivered</option>
                                <option value="Cancelled" <?php if($order['order_status'] == 'Cancelled'){echo "selected";} ?>>Cancelled</option>

                            </select>
                        </div>
                        
                        <div class="form-group my-5">
                            <input type="submit" class="btn btn-primary me-5" name="edit_order" value="Save">
                            <input type="submit" class="btn btn-danger" name="cancel_order" value="Cancel">
                        </div>
                        <?php } ?>

                    </form>

                </div>

            </div>

        </main>
    </div>
</div>

