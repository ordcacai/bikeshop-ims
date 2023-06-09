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

                                <option value="">--Select Payment Method--</option>
                                <optgroup label="Cash Payments">
                                    <option value="BPI (Bank Transfer)">BPI (Bank Transfer)</option>
                                    <option value="BDO (Bank Transfer)">BDO (Bank Transfer)</option>
                                    <option value="GCash">GCash</option>
                                    <option value="Cash">Cash</option>
                                </optgroup>
                                <optgroup label="Installment">
                                    <option value="homecredit">Home Credit</option>
                                    <option value="billease">BillEase</option>
                                    <option value="atome">Atome</option>
                                    <option value="bdocreditcard">BDO Credit Card</option>
                                </optgroup>

                            </select>
                </div>

                <div class="form-group checkout-small-element">
                            <label><strong>Shipping Method</strong></label>
                            <select class="form-select" required name="shipping_method">

                                    <option value="">-- Select Shipping Method --</option>
                                    <option value="In-house Delivery">In-house Delivery (Selected Areas in Metro Manila only)</option>
                                    <option value="Victory Liner Drop & Go and other bus cargo">Victory Liner Drop & Go and other bus cargo (Luzon Area)</option>
                                    <option value="Capex">Capex</option>
                                    <option value="AP Cargo">AP Cargo</option>
                                    <option value="Jades Cargo">Jades Cargo</option>
                                    <option value="Seastar Cargo">Seastar Cargo</option>

                            </select>
                </div>

                <!-- <div class="form-group checkout-small-element">
                            <label><strong>Proof of Payment</strong></label>
                            <input type="file" class="form-control" id="checkout-payment" name="payment" placeholder="Payment" required>
                </div> -->

                <div class="form-group checkout-btn-container">
                    <p>Total: ₱<?php echo number_format($_SESSION['total'],2); ?></p>
                    <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Place Order">
                </div>
            </form>
        </div>
    </section>

    <?php include('layouts/footer.php'); ?>