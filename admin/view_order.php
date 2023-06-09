<?php include('header.php'); ?>

<?php
    if(!isset($_SESSION['logged_in'])){
        header('location: ../login.php');
        exit;
    }
?>

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

    $stmt2 = $conn->prepare("SELECT * FROM payments WHERE order_id = ?");
    $stmt2->bind_param("i", $order_id);
    $stmt2->execute();
    $payments = $stmt2->get_result();//array

}else{
    header('location: orders.php');
}
   

?>
<?php include('security.php');
include('sidemenu.php'); ?>

<div class="main-content">
<a href="orders.php" class="return"><i class="fas fa-chevron-circle-left"></i></a>
    <div class="container">

            <h1 class="my-5">Order ID: <?php echo $order_id?></h1>

                <?php if(isset($_GET['order_updated'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['order_updated']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['order_update_failed'])){ ?>
                    <p class="text-center" style="color: red;"><?php echo $_GET['order_update_failed']; ?></p>   
                <?php }?>

        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Color</th>
                            <th scope="col">Product Price</th>
                            <th scope="col">Product Quantity</th>
                        </tr>
                    </thead>

                    <?php while($row = $order_items->fetch_assoc()){ ?>
                    <tbody>

                        <tr>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['product_color']; ?></td>
                            <td><?php echo "₱".number_format($row['product_price'],2); ?></td>
                            <td><?php echo $row['product_quantity']; ?></td>
                        </tr>

                    </tbody>
                    <?php } ?>
                </table>
            <?php while($row = $orders->fetch_assoc()){ ?>
                <p class="my-2" style="float: right; font-size: 20px"><strong class="text-success">Total: </strong><?php echo number_format($row['order_cost']); ?></p>
            </div>
        </div>
        <h3 class="mt-4">Order Information:</h3>
        <hr>
        <div class="container">
                <p style="font-size: 15px;"><strong>Customer Name:</strong> <?php echo $row['user_name'] ?></p>
                <p style="font-size: 15px;"><strong>Contact #:</strong> <?php echo "+63".$row['user_phone'] ?></p>
                <p style="font-size: 15px;"><strong>Address:</strong> <?php echo $row['user_address'] ?></p>
                <p style="font-size: 15px;"><strong>Landmark:</strong> <?php echo $row['user_landmark'] ?></p>
                <p style="font-size: 15px;"><strong>Location Link:</strong> <?php echo $row['location_link'] ?></p>
                <p style="font-size: 15px;"><strong>Shipping Method:</strong> <?php echo $row['shipping_method'] ?></p>
            <?php } ?>   
        </div><br>
        <?php while($row = $payments->fetch_assoc()){ ?>
        <h3 class="mt-4">Payment Information:</h3>
        <hr>
        <div class="container">
                <p style="font-size: 15px;"><strong>Amount Received:</strong> ₱<?php echo number_format($row['amount'],2); ?></p>
                <p style="font-size: 15px;"><strong>Reference Number:</strong> <?php echo $row['ref_num'] ?></p>
                <p style="font-size: 15px;"><strong>Payment Date:</strong> <?php echo $row['pay_date'] ?></p>
                <p style="font-size: 15px;"><strong>Payment Method:</strong> <?php echo $row['mop'] ?></p>
                <p style="font-size: 15px;"><strong>Notes:</strong> <?php echo $row['notes'] ?></p>
                <?php } ?>

                <?php if ($payments->num_rows === 0) { ?>
                <h3 class="mt-4">Payment Information:</h3>
                <hr>
                <div class="container">
                    <p style="font-size: 15px;">No payment information found for this order.</p>
                </div>
                <?php } ?>

            <a class="btn btn-primary my-5 px-5" href="edit_order.php?order_id=<?php echo $order_id ?>" style="float: right;" >Edit</a> 
        </div>
    </div>
</div> 
