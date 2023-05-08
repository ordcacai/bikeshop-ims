<?php

    include('layouts/header.php');

?> 

<?php


if ( !empty($_SESSION['cart'])){

    //let user access place order

}else{
    //do not let user access place order
    echo '<script>alert("Cart empty!");</script>';
    header('location: cart.php');

}

?>   

    <!-- Check Out -->

    <section class="my-t py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold mt-3 my-3">Order Request</h2>
            <hr class="mx-auto">
        </div>

        <div class="mx-auto container">
            <form id="checkout-form" enctype="multipart/form-data" method="POST" action="server/place_order.php">
                <p class="text-center" style="color: red;">
                    <?php if(isset($_GET['message'])){ echo $_GET['message']; } ?>
                    <?php if(isset($_GET['message'])){ ?>

                        <a href="login.php" class="button">Login</a>

                    <?php } ?>
                </p>

                <div class="form-group checkout-small-element">
                    <label><strong>Name:</strong></label>
                    <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required>
                </div>

                <div class="form-group checkout-small-element">
                    <label><strong>Email:</strong></label>
                    <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
                </div>

                <div class="form-group checkout-small-element">
                    <label><strong>Phone No.:</strong></label>
                    <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Phone No." required>
                </div>

                <div class="form-group checkout-small-element">
                    <label><strong>City:</strong></label>
                    <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required>
                </div>

                <div class="form-group checkout-large-element">
                    <label><strong>Address:</strong></label>
                    <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required>
                </div>

                <div class="form-group checkout-small-element">
                    <label><strong>Landmark:</strong></label>
                    <input type="text" class="form-control" id="checkout-landmark" name="landmark" placeholder="Landmark" required>
                </div>

                <div class="form-group checkout-small-element">
                    <label><strong>Location Link:</strong></label>
                    <input type="text" class="form-control" id="checkout-location" name="location" placeholder="Location" required>
                </div>

                <div class="form-group checkout-small-element">
                            <label><strong>Payment Method</strong></label>
                            <select class="form-select" required name="payment_method">

                                <option value="E-Wallet">E-Wallet</option>
                                <option value="Online Banking">Online Banking</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="COD">Cash on Delivery</option>

                            </select>
                </div>

                <div class="form-group checkout-small-element">
                            <label><strong>Shipping Method</strong></label>
                            <select class="form-select" required name="shipping_method">

                                <option value="LBC">LBC</option>
                                <option value="Lalamove">Lalamove</option>
                                <option value="Grab">Grab</option>
                                <option value="J&T">J&T</option>

                            </select>
                </div>

                <!-- <div class="form-group checkout-small-element">
                            <label><strong>Proof of Payment</strong></label>
                            <input type="file" class="form-control" id="checkout-payment" name="payment" placeholder="Payment" required>
                </div> -->

                <div class="form-group checkout-btn-container">
                    <p>Total: ₱<?php echo $_SESSION['total']; ?></p>
                    <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Place Order">
                </div>
            </form>
        </div>
    </section>

    <?php include('layouts/footer.php'); ?>