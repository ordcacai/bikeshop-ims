<?php include('header.php'); ?>

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

            <h2 class="form-weight-bold mt-3 my-3">Add Orders</h2>
            <div class="table-responsive">

                <div class="mx-auto container">

                    <form id="create-form" enctype="multipart/form-data" method="POST" action="create_order.php">
                        <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>

                        <div class="form-group mt-2">
                            <label><strong>Customer Name</strong></label>
                            <input type="text" class="form-control" id="customer-name" name="name" placeholder="Customer Name" required>
                        </div>
                        
                        <div class="form-group mt-2">
                            <label><strong>Contact Number</strong></label>
                            <input type="text" class="form-control" id="contact-number" name="phone" placeholder="Contact Number" required>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Address</strong></label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Landmark</strong></label>
                            <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Landmark" required>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Location Link (Maps/Waze)</strong></label>
                            <input type="text" class="form-control" id="location-link" name="location" placeholder="Location Link" required>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Order Date</strong></label>
                            <input type="text" class="form-control" id="order-date" name="date" placeholder="Order Date" required>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Order Status</strong></label>
                            <select class="form-select" required name="category">

                                <option value="not paid">Not Paid</option>
                                <option value="paid">Paid</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>

                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Purchased Item/s</strong></label>
                            <input type="text" class="form-control" id="item-purchase" name="purchase" placeholder="Purchased Item/s" required>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Item Price</strong></label>
                            <input type="text" class="form-control" id="item-price" name="price" placeholder="Price" required>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Total</strong></label>
                            <input type="text" class="form-control" id="total" name="total" placeholder="Total" required>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Payment Method</strong></label>
                            <select class="form-select" required name="category">

                                <option value="E-Wallet">E-Wallet</option>
                                <option value="Online Banking">Online Banking</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="COD">Cash on Delivery</option>

                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Mode of Shipping</strong></label>
                            <select class="form-select" required name="category">

                                <option value="LBC">LBC</option>
                                <option value="Lalamove">Lalamove</option>
                                <option value="Grab">Grab</option>

                            </select>
                        </div>
                        
                        <div class="form-group my-5">
                            <input type="submit" class="btn btn-primary me-5" name="add_order" value="Add Order">
                            <input type="submit" class="btn btn-danger" name="cancel_btn" value="Cancel">
                        </div>

                    </form>

                </div>

            </div>

        </main>
    </div>
</div>

