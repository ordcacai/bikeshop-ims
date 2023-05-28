<?php include('header.php'); ?>

<?php
    if(!isset($_SESSION['logged_in'])){
        header('location: ../login.php');
        exit;
    }
?>
<?php include('security.php');
include('sidemenu.php'); ?>

<?php

if(isset($_GET['order_id'])){

    $order_id = $_GET['order_id'];

    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $orders = $stmt->get_result();//array

    $stmt1 = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $stmt1->bind_param("i", $order_id);
    $stmt1->execute();
    $order_items = $stmt1->get_result();//array

}else if(isset($_POST['invoice_submit'])){

    $order_id = $_POST['order_id'];
    $shipping_fee = $_POST['shipping_fee'];
    

    $stmt = $conn->prepare("UPDATE orders SET shipping_fee=? WHERE order_id = ?");
    $stmt->bind_param('si', $shipping_fee, $order_id);
    $stmt->execute();
    
    if($stmt->execute()){

    header('location: invoice.php?invoice_created=Invoice has been created successfully!');

    }else{

    header('location: invoice.php?invoice_failed=Error occured, Please try again.');

    }

}else{
    header('location: view_order.php');
}

?>

<div class="main-content">
<a href="invoice.php" class="return"><i class="fas fa-chevron-circle-left"></i></a>
    <div class="container p-5">
        <h2 class="form-weight-bold mb-5">Create Invoice</h2>
        <form method='POST' action='create_invoice.php'>
        <div class='row'>
                <div class='col-md-12'>
                    <h5 class='text-success mb-4'>Product Details</h5>
                    <table class='table table-bordered table-striped table-hover'>
                    <thead>
                        <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Color</th>
                        <th>Qty</th>
                        <th>Total</th>
                        </tr>
                    </thead>
                    <?php while($row = $order_items->fetch_assoc()){ ?>
                    <tbody id='product_tbody'>
                        <tr>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['product_price']; ?></td>
                        <td><?php echo $row['product_color']; ?></td>
                        <td><?php echo $row['product_quantity']; ?></td>
                        <td><?php echo $row['product_price']; ?></td>
                        </tr>
                    </tbody>
                    <?php } ?>
                    <?php while($row = $orders->fetch_assoc()){ ?>
                    <tfoot>
                        <tr>
                        <td colspan='4' class='text-right text-success' style="text-align: end;">Sub Total:</td>
                        <td class="text-danger"><?php echo $row['order_cost']; ?></td>
                        </tr>
                    </tfoot>
                    </table>
                    <p class='text-right' style="text-align: end;">Shipping Fee: <input type='number' name='shipping_fee' id='shipping_fee' class='p-1' required></p>
                    
                </div>
                </div>
                <div class='row'>
                <div class='col-md-4 mt-3'>
                    <h5 class='text-success mt-3'>Invoice Details</h5>

                    <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
                    <div class='form-group my-3'>
                    <label>Order No.</label>
                    <p style="font-size: 15px;"><?php echo $row['order_id'] ?>
                    </div>
                    <div class='form-group my-3'>
                    <label>Order Date</label>
                    <p style="font-size: 15px;"><?php echo $row['order_date'] ?>
                    </div>
                </div>
                <div class='col-md-8 mt-3'>
                    <h5 class='text-success mt-3'>Customer Details</h5>
                    <div class='form-group my-3'>
                    <label>Customer Name</label>
                    <p style="font-size: 15px;"><?php echo $row['user_name'] ?></p>
                    </div>
                    <div class='form-group my-3'>
                    <label>Contact No.</label>
                    <p style="font-size: 15px;"><?php echo "+63".$row['user_phone'] ?></p>
                    </div>
                    <div class='form-group my-3'>
                    <label>Address</label>
                    <p style="font-size: 15px;"><?php echo $row['user_address'] ?></p>
                    </div>
                    <div class='form-group my-3'>
                    <label>Landmark</label>
                    <p style="font-size: 15px;"><?php echo $row['user_landmark'] ?></p>
                    </div>
                    <div class='form-group my-3'>
                    <label>Payment Method</label>
                    <p style="font-size: 15px;"><?php echo $row['payment_method'] ?></p>
                    </div>
                    <div class='form-group my-3 mb-5'>
                    <label>Shipping Method</label>
                    <p style="font-size: 15px;"><?php echo $row['shipping_method'] ?></p>
                    </div>
                </div>
                <?php } ?>
                </div>
                <input type='submit' name='invoice_submit' value='Save Invoice' class='btn btn-success' style=" float: right;">
            </form>
        </div>
    </div>