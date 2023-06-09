<?php include('header.php'); ?>

<?php
    if(!isset($_SESSION['logged_in'])){
        header('location: ../login.php');
        exit;
    }
?>

<?php

    //1. determine page no.
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        //if user has already entered page then page number is the one that they selected
        $page_no = $_GET['page_no'];
    }else{
        //if user just entered the page then default page is 1
        $page_no = 1;
    }

    //2. return number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM orders");
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    //3. products per page
    $total_records_per_page = 5;
    $offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";
    $total_no_of_pages = ceil($total_records/$total_records_per_page);

    //4. get all products
    $stmt2 = $conn->prepare("SELECT * FROM orders ORDER BY order_id DESC LIMIT $offset, $total_records_per_page");
    $stmt2->execute();
    $orders = $stmt2->get_result();//array

?>
<?php



?>
<?php include('security.php');
include('sidemenu.php'); ?>

<div class="main-content">
    <div class="container-fluid">
            <h1 class="my-4">Invoice and Payments</h1>
        
                <?php if(isset($_GET['invoice_created'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['invoice_created']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['invoice_failed'])){ ?>
                    <p class="text-center" style="color: red;"><?php echo $_GET['invoice_failed']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['invoice_uploaded'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['invoice_uploaded']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['invoice_sent'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['invoice_sent']; ?></p>   
                <?php }?>
            
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-sm text-center">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">Manage Invoice</th>
                            <th scope="col">Manage Payment</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php while($row = $orders->fetch_assoc()) { ?>
                        <tr>
                            <td><a href="<?php echo "create_invoice.php?order_id=".$row['order_id']; ?>"><?php echo $row['order_id']; ?></a></td>
                            <td><?php echo $row['user_name']; ?></td>
                            <td><?php echo $row['order_date']; ?></td>
                            <td><?php echo $row['order_status']; ?></td>
                            <td>
                                <?php $_SESSION['user_type'] == 'admin' && $_SESSION['user_type'] == 'employee' ?>
                                    <a class="btn btn-outline-secondary action-btn" href="invoice_success.php?order_id=<?php echo $row['order_id']; ?>&ACTION=VIEW" target="_blank"><i class="fas fa-eye"></i></a>
                                    <a class="btn btn-outline-primary action-btn" href="invoice_success.php?order_id=<?php echo $row['order_id']; ?>&ACTION=UPLOAD"><i class="fas fa-upload"></i></a>
                                    <a class="btn btn-outline-danger action-btn" href="invoice_success.php?order_id=<?php echo $row['order_id']; ?>&ACTION=DOWNLOAD"><i class="fas fa-download"></i></a>
                                    <a class="btn btn-outline-info action-btn" href="invoice_success.php?order_id=<?php echo $row['order_id']; ?>&ACTION=EMAIL" onclick="hideButtonWithConfirmation(this, event, '<?php echo $row['user_name']; ?>', 'Are you sure you want to send an email to ' + '<?php echo $row['user_name']; ?>' + '?')"><i class="fas fa-envelope"></i></a>
                                    <a class="btn btn-outline-success action-btn" href="invoice_success.php?order_id=<?php echo $row['order_id']; ?>&ACTION=COMPLETE" onclick="hideButtonWithConfirmation(this, event, '<?php echo $row['user_name']; ?>', 'You are about to confirm this order, do you want to proceed?')"><i class="fas fa-check"></i></a>

                                    
                            </td>
                            <!--Check if payment is already recorded-->
                            <td>
                            <?php
                                $order_id = $row['order_id']; // Get the order ID
                                $check_payment_stmt = $conn->prepare("SELECT * FROM payments WHERE order_id = ?");
                                $check_payment_stmt->bind_param('i', $order_id);
                                $check_payment_stmt->execute();
                                $payment_result = $check_payment_stmt->get_result();

                                if ($payment_result->num_rows > 0) {
                                    // Payment record exists, disable the payment button
                                    ?>
                                    <button class="btn btn-outline-success" disabled><i class="fas fa-pen"></i></button>
                                <?php } else { ?>
                                    <!-- Payment record does not exist, enable the payment button -->
                                    <a class="btn btn-outline-success" href="<?php echo "payment.php?order_id=" . $row['order_id']; ?>"><i class="fas fa-pen"></i></a>
                                <?php } ?>
                            </td>

                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                    <nav aria-label="Page navigation example" class="text-center">
                    <ul class="pagination mt-5 justify-content-center">
                        <li class="page-item">
                            <a class="page-link <?= ($page_no <= 1) ? 'disabled' : ''; ?> " <?= ($page_no > 1) ? 'href=?page_no=' .$previous_page : ''; ?>>Previous</a>
                        </li>


                        <li class="page-item"><a href="?page_no=1" class="page-link">1</a></li>
                        <li class="page-item"><a href="?page_no=2" class="page-link">2</a></li>

                            <?php if($page_no >= 3) { ?>
                                <li class="page-item"><a href="#" class="page-link">...</a></li>
                                <li class="page-item"><a href="?page_no=<?= $page_no; ?>" class="page-link"><?= $page_no; ?></a></li>
                            <?php } ?>

                        <li class="page-item">
                            <a class="page-link <?= ($page_no >= $total_no_of_pages) ? 'disabled' : ''; ?> " <?= ($page_no < $total_no_of_pages) ? 'href=?page_no=' .$next_page : ''; ?>>Next</a>
                        </li>

                    </ul>
                </nav>

                <div class="p-10">
                    <strong>Page <?= $page_no; ?> of <?= $total_no_of_pages ?></strong>
                </div>

            </div>
    </div>
</div> 

<script>
        function hideButton(button) {
// Hide the button by setting its display property to "none"
        button.style.display = "none";

// Optional: You can store the hidden state in local storage or a cookie
        localStorage.setItem(button.getAttribute("href"), "hidden");
        }

        function hideButtonWithConfirmation(button, event, user_name, confirmationMessage) {
        event.preventDefault();
        if (confirm(confirmationMessage)) {
            hideButton(button);
            window.location.href = button.getAttribute("href");
        }
        }

// Check if the buttons were previously hidden and hide them on page load
        document.addEventListener("DOMContentLoaded", function() {
        var buttons = document.getElementsByClassName("action-btn");
        for (var i = 0; i < buttons.length; i++) {
            var button = buttons[i];
            var href = button.getAttribute("href");
            var hiddenState = localStorage.getItem(href);
            if (hiddenState === "hidden") {
            button.style.display = "none";
            }
        }
    });
</script>
