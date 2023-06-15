<?php include('header.php'); 
include('sidemenu.php');?>

<?php
    if(!isset($_SESSION['logged_in'])){
        header('location: ../login.php');
        exit;
    }
?>


<div class="main-content">
    <div class="container-fluid">
        <h1 class="my-4">Payment for Order ID: </h1>
        <div class="table-responsive">

                <div class="mx-auto container">

                    <form id="create-form" enctype="multipart/form-data" method="POST" action="">
                        <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>

                        <div class="form-group mt-2">
                            <label><strong>Customer Name</strong></label>
                            <input type="text" class="form-control" id="cust_name" name="name" placeholder="Customer Name" readonly>
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
                                <input type="text" class="form-control" id="ref_number" name="ref_" required>
                            </div>
                        
                            <div class="form-group mt-2">
                                <label><strong>Mode of Payment</strong></label>
                                <input type="text" class="form-control" id="mop" name="mop" placeholder="Mode of Payment" required>
                            </div>
                        </div>
                        
                    </div>

                        <div class="form-group mt-2">
                            <label><strong>Notes</strong></label>
                            <textarea class="form-control" id="notes" name="notes" rows="7" placeholder="Notes" required></textarea>
                        </div>

                        <div class="form-group mt-2">
                                <label><strong>Attach File</strong></label>
                                <input type="file" class="form-control" id="image4" name="image4" placeholder="Image 4" >
                        </div>
                        
                        <div class="form-group my-5">
                            <input type="submit" class="btn btn-primary me-5" name="record_payment" value="Record Payment">
                            <a class="btn btn-danger" href="invoice.php">Cancel</a>
                        </div>

                    <br>

                    </form>

                </div>
            </div>

    </div>
</div>
