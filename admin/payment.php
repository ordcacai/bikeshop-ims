<?php include('header.php'); 
include('security.php');
include('sidemenu.php');?>

<?php

// Check if order_id is provided in the URL
if (!isset($_GET['order_id'])) {
    header('location: invoice.php');
    exit;
}

// Retrieve the order details from the database based on the provided order_id
$order_id = $_GET['order_id'];
$stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_assoc();

?>


<div class="main-content">
    <div class="container-fluid">
        <h1 class="my-4">Payment for Order ID: <?php echo $orders['order_id']; ?></h1>
        <div class="table-responsive">

                <div class="mx-auto container">

                    <form id="create-form" enctype="multipart/form-data" method="POST" action="record_payment.php">
                        <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>

                        <div class="form-group mt-2">
                            <label><strong>Customer Name</strong></label>
                            <input type="text" class="form-control" id="cust_name" name="name" value="<?php echo $orders['user_name']; ?>" readonly>
                        </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group mt-2">
                                <label><strong>Amount Received</strong></label>
                                <input type="text" class="form-control" id="amount_received" name="amount" required>
                            </div>
                        
                            <div class="form-group mt-2">
                                <label for="selectedDate"><strong>Payment Date</strong></label>
                                <input type="date" class="form-control" id="selectedDate" name="payment_date" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group mt-2">
                                <label><strong>Reference Number</strong></label>
                                <input type="text" class="form-control" id="ref_number" name="ref_num" required>
                            </div>
                        
                            <div class="form-group mt-2">
                                <label><strong>Mode of Payment</strong></label>
                                <input type="text" class="form-control" id="mop" name="mop" value="<?php echo $orders['payment_method']; ?>" readonly>
                            </div>
                        </div>
                        
                    </div>

                        <div class="form-group mt-2">
                            <label><strong>Notes</strong></label>
                            <textarea class="form-control" id="notes" name="notes" rows="7" placeholder="Notes" required></textarea>
                        </div>

                        <div class="form-group mt-2">
                                <label><strong>Attach File</strong></label>
                                <input type="file" class="form-control" id="image" name="image" placeholder="Image" required>
                        </div>
                        
                        <input type="hidden" name="order_id" value="<?php echo $orders['order_id']; ?>">


                        <div class="form-group my-5">
                            <input type="submit" class="btn btn-primary me-5" name="record_payment" value="Record Payment" 
                            onclick="return confirm('Are you sure you want to submit the payment? Once you clicked OK, the record will be final and cannot be changed.');">      
                            <a class="btn btn-danger" href="invoice.php">Cancel</a>
                        </div>

                    <br>

                    </form>

                </div>
            </div>

    </div>
</div>
