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
    $date_cancelled = $_POST['date_cancelled'];
    $cancel_reason = $_POST['cancel_reason'];
    $date_delivered = $_POST['date_delivered'];
    $date_shipped = $_POST['date_shipped'];
    $track_num = $_POST['track_num'];

    if($status == 'Shipped'){
    $stmt = $conn->prepare("UPDATE orders SET order_status = ?, track_number = ?, date_shipped = ? WHERE order_id = ?");
    $stmt->bind_param('sssi', $status, $track_num, $date_shipped, $order_id);
    $stmt->execute();
    }else if($status == 'Delivered'){
        $stmt = $conn->prepare("UPDATE orders SET order_status = ?, date_received = ? WHERE order_id = ?");
        $stmt->bind_param('ssi', $status, $date_delivered, $order_id);
        $stmt->execute();
    }else if($status == 'Cancelled'){
        $stmt = $conn->prepare("UPDATE orders SET order_status = ?, cancel_reason = ?, cancel_date = ? WHERE order_id = ?");
        $stmt->bind_param('sssi', $status, $cancel_reason, $date_cancelled, $order_id);
        $stmt->execute();
    }else{
        header('location: orders.php');
    }

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

                        <?php if($order['order_status'] == 'Pending'){ ?>
                        <div class="form-group my-3">
                            <label><strong>Order Status</strong></label>
                            <select class="form-select" required name="status" id="category">
                            
                                <option value="Pending" <?php if($order['order_status'] == 'Pending'){echo "selected";} ?>>Pending</option>
                                <option value="Shipped" <?php if($order['order_status'] == 'Shipped'){echo "selected";} ?>>For Delivery/Ship out</option>
                                <option value="Cancelled" <?php if($order['order_status'] == 'Cancelled'){echo "selected";} ?>>Cancelled</option>

                            </select>
                        </div>
                        <?php }else if($order['order_status'] == 'Shipped'){?>
                            <div class="form-group my-3">
                            <label><strong>Order Status</strong></label>
                            <select class="form-select" required name="status" id="category">

                                <option value="Shipped" <?php if($order['order_status'] == 'Shipped'){echo "selected";} ?>>For Delivery/Ship out</option>
                                <option value="Delivered" <?php if($order['order_status'] == 'Delivered'){echo "selected";} ?>>Delivered</option>

                            </select>
                        </div>
                        <?php }?>

                        <div class="form-group mt-2" style="display: none" id="date_cancelled">
                            <label><strong>Date Cancelled</strong></label>
                            <input style="width:300px" type="date" class="form-control" name="date_cancelled" id="required_cancel">
                        </div>

                        <div class="form-group" style="display: none" id="cancel_reason">
                            <label><strong>Select Cancel Reason</strong></label>
                            <select class="form-control" name="cancel_reason" id="required_cancel">

                            <option value="null">--SELECT REASON--</option>
                            <option value="Change of shipping information">I want to change my shipping information</option>
                            <option value="Change of mind">I changed my mind</option>
                            <option value="Change of payment method">Change payment method</option>
                            <option value="Wrong Product">Wrong Product</option>  
                            </select>
                        </div>


                        <div class="form-group mt-2" style="display: none" id="date_delivered">
                            <label><strong>Date Delivered</strong></label>
                            <input style="width:300px" type="date" class="form-control" name="date_delivered" id="required_delivered" value="<?php echo $order['date_received'] ?>">
                        </div>

                        <div class="form-group mt-2" style="display: none" id="date_shipped">
                            <label><strong>Date Shipped</strong></label>
                            <input style="width:300px" type="date" class="form-control" name="date_shipped" id="required_shipped" value="<?php echo $order['date_shipped'] ?>">
                        </div>

                        <div class="form-group mt-2" style="display: none" id="track_num">
                            <label><strong>Track Number</strong></label>
                            <input style="width:300px" type="text" class="form-control" name="track_num" id="required_track" value="<?php echo $order['track_number'] ?>">
                        </div>
                        
                        <div class="form-group my-5">
                            <input type="submit" class="btn btn-primary me-5" name="edit_order" value="Save">
                            <a href="orders.php" class="btn btn-danger">Cancel</a>
                        </div>
                        <?php } ?>

                    </form>

                </div>

            </div>

        </main>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $('#category').change(function() {

      if ($(this).val() == 'Shipped') {
        $('#required_shipped').attr("required", true);
        $('#required_track').attr("required", true);
        $('#date_shipped').show();
        $('#track_num').show();
        $('#date_delivered').hide();
        $('#date_cancelled').hide(); 
        $('#cancel_reason').hide();   
      }else if ($(this).val() == 'Delivered'){
        $('#required_delivered').attr("required", true);
        $('#date_delivered').show();
        $('#date_cancelled').hide();
        $('#cancel_reason').hide();
        $('#date_shipped').hide();
        $('#track_num').hide();
      }else if ($(this).val() == 'Cancelled'){
        $('#date_cancelled').attr("required", true);
        $('#required_cancel').attr("required", true);
        $('#date_cancelled').show();
        $('#cancel_reason').show();
        $('#date_delivered').hide();
        $('#date_shipped').hide();
        $('#track_num').hide();
      }else {
        $('#date_cancelled').hide();
        $('#cancel_reason').hide();
        $('#date_delivered').hide();
        $('#date_shipped').hide();
        $('#track_num').hide();
      }
    });

  });
</script>
