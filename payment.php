<?php

    include('layouts/header.php');

?> 

<?php

if(isset($_POST['order_pay_btn'])){

    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];


}
?>

<!-- Payment -->

    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="text-success form-weight-bold mt-5">Order Request Successful!</h2>
            <hr class="mx-auto">
        </div>

        <div class="mx-auto container text-center">
            <p class="mt-5">Please wait for an invoice of your order. Thank you!</p>

            <!-- <?php if(isset($_SESSION['total']) && $_SESSION['total'] !=0){ ?>
            <?php $amount = strval($_SESSION['total']); ?>
                <p>Total Payment: ₱<?php echo $_SESSION['total']; ?></p>

            <?php }else if(isset($_POST['order_status']) && $_POST['order_status'] == "not paid"){ ?>
            <?php $amount = strval($_POST['order_total_price']); ?>
                <p>Total Payment: ₱<?php echo $_POST['order_total_price']; ?></p>

            <?php }else{ ?>
                <p>You don't have an order.</p>
            <?php } ?> -->
    
        </div>
    </section>


<?php include('layouts/footer.php'); ?>