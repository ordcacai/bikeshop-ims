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

        header('location: orders.php?order_updated=Order has been updated successfully!');
        
    }else{

        header('location: orders.php?order_update_failed=Error occured, Please try again.');

    }

}else{
    header('location: orders.php');
    exit;
}




?>

<div class="container-fluid">
    <div class="row" style="min-height:1000px">

        <?php include('sidemenu.php'); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 mt-2">
                <h1 class="primary">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2"></div>
                </div>
            </div>

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
                            <p class="my-4"><?php echo $order['order_cost']; ?></p>
                        </div>

                        <div class="form-group my-3">
                            <label><strong>Order Date</strong></label>
                            <p class="my-4"><?php echo $order['order_date']; ?></p>
                        </div>

                        <div class="form-group my-3">
                            <label><strong>Order Status</strong></label>
                            <select class="form-select" required name="status">
                            
                                <option value="not paid" <?php if($order['order_status'] == 'not paid'){echo "selected";} ?>>Not Paid</option>
                                <option value="paid" <?php if($order['order_status'] == 'paid'){echo "selected";} ?>>Paid</option>
                                <option value="shipped" <?php if($order['order_status'] == 'shipped'){echo "selected";} ?>>Shipped</option>
                                <option value="delivered" <?php if($order['order_status'] == 'delivered'){echo "selected";} ?>>Delivered</option>

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

