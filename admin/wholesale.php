<?php include('header.php'); ?>

<?php include('sidemenu.php'); ?>

<?php 

$stmt = $conn->prepare('SELECT * FROM products');
$stmt->execute();
$product = $stmt->get_result();

?>

<div class="main-content">
    <div class="container-fluid">
    <i class="fas fa-chevron-circle-left" style="font-size: 50px; color: #f9881c; cursor: pointer;" onclick="goBack()" onmouseover="this.style.backgroundColor='#d6d6d7'" onmouseout="this.style.backgroundColor='transparent'"></i>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
            <h1 class="my-4">Add Orders</h1>
                <div class="mx-auto container">
                <h2 class="my-4">Order Information</h2>
                
                <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 100%;">
                    <form method="POST" enctype="multipart/form-data" action="create_order_wholesale.php">
                                <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>

                                <h4 class="my-4">Order Type <span class="badge rounded-pill bg-warning">Select Order Type</span></h4>
                                <select class="form-control" id="orderType" required name="order_type" style="width: 300px" onchange="redirectPage()">
                                    <option value="wholesale">Wholesale</option>
                                    <option value="retail">Retail</option>
                                </select>
                            <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 100%;">
                                <!-- WHOLESALE LABEL -->
                            <h4 class="my-4">Package Label Information <span class="badge rounded-pill bg-success">FOR WHOLESALE ONLY</span></h4>

                                    <div class="form-group mt-2">
                                    <label><strong>Name:</strong></label>
                                        <input type="text" class="form-control"  name="wsname" placeholder="Ex: Lalisa Manoban">
                                    </div>

                                    <div class="form-group mt-2">
                                    <label><strong>Phone Number:</strong></label><br>
                                        <input type="tel" class="form-control" id="wsphone" name="wsphone" placeholder="Ex: 09*********">
                                    </div>

                                    <div class="form-group mt-2">
                                    <label><strong>Address:</strong></label>
                                        <textarea class="form-control" id="wsaddress" name="wsaddress" placeholder="Ex: 59C. Gen. Ordoñez Ave., Marikina City"></textarea>
                                    </div>

                                    <div class="form-group mt-2">
                                    <label><strong>Preferred Courier:</strong></label>
                                        <input type="text" class="form-control" id="wscourier" name="wscourier" placeholder="Ex: Lalamove">
                                    </div>

                                    <div class="form-group mt-2">
                                        <br><button type="button" class="btn btn-secondary" style="float: right;" id="clearButton">Clear</button><br>
                                    </div><br>
                        <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 100%;">
                                    <!-- ORDER STATUS -->
                                    <h4 class="my-4">Customer Information</h4>
                        <label for="orderStatus"><strong>Order Status</strong></label>
                                <select class="form-control" id="orderStatus" name="order_status" style="width: 500px">
                                    <option value="">-- Select Order Status --</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Shipped">For Delivery/Ship out</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Cancelled">Cancelled</option>
                                    <option value="Walk-In">Walk-In</option>
                                </select><br>
                                <!--MAIN FORM-->
                                <div class="form-group mt-2">
                                    <label><strong>Name:</strong></label>
                                    <input type="text" class="form-control" id="name" name="name" required placeholder="Ex: Juan Dela Cruz">
                                </div>
                                
                                <div class="form-group mt-2">
                                    <label><strong>Phone Number:</strong></label><br>
                                    <input type="tel" class="form-control" id="phone" name="phone" required placeholder="Ex: 09*********">
                                </div>

                                <div class="form-group mt-2">
                                    <label><strong>Address:</strong></label><br>
                                    <textarea class="form-control" id="address" name="address" required placeholder="Ex: 59C. Gen. Ordoñez Ave., Marikina City"></textarea>
                                </div>
                                
                                <div class="form-group mt-2">
                                    <label><strong>Nearest Landmark:</strong></label><br>
                                    <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Ex: Manila Post Office">
                                </div>

                                <div class="form-group mt-2">
                                    <label><strong>Location Link:</strong><span class="badge rounded-pill bg-warning">Include the "https://www."</span></label><br>
                                    <input type="url" class="form-control" id="location" name="location" placeholder="Ex: https://ul.waze.com/ul?ll=69.....">
                                </div>

                                <div class="form-group mt-2">
                                    <br><button type="button" class="btn btn-secondary" style="float: right;" id="clearButton">Clear</button><br>
                                </div><br>

                                <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 100%;">
                                <h4>Add Stocks  <button type="button" class="add-more-form btn btn-primary ">+</button></h4>

<div class="container dynamicForm">
        <div>
            <div class="row">
                <input type="hidden" class="form-control sl" name="row[]" value=1>
                <div class="col-md-4">
                <label for="selectedOption"><strong>Product Name</strong></label>
                        <select class="form-select" required name="product-name[]" required>
                            <option value="">Select an option</option>
                            
                            <?php while($row = $product->fetch_assoc()){ ?>

                            <option value="<?php echo $row['product_id'];?>"><?php echo $row['product_name'];?></option>

                            <?php } ?>
                            
                        </select>
                </div>
                <div class="col-md-3">
                    <label><strong>Color & Size</strong></label>
                    <input type="text" class="form-control" placeholder="Color & Size" name="color_size[]">
                </div>
                <div class="col-md-2">
                    <label><strong>Price</strong></label>
                    <input type="number" class="form-control" placeholder="Price" name="price[]">
                </div>
                <div class="col-md-2">
                    <label><strong>Quantity</strong></label>
                    <input type="number" class="form-control" placeholder="Quantity" name="quantity[]">
                </div>
                <div class="col-md-1">
                    <label><strong>Remove</strong></label>
                    <button type="button" class="remove-btn btn btn-danger form-control"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>

                            <div class="row">
                                <div class="col">
                                <label for="itemName"><strong>Item Name:</strong></label>
                                </div>
                                <div class="col">
                                <label for="price"><strong>Price:</strong></label>
                                </div>
                                <div class="col">
                                <label for="colorSize"><strong>Color and Size:</strong></label>
                                </div>
                                <div class="col">
                                <label for="quantity"><strong>Quantity:</strong></label>
                                </div>
                                <div class="col"></div> <!-- Empty column-->
                            </div>

                            <div class="row">
                                <div class="col">&nbsp;</div> <!-- Label with white space -->
                            </div>
                            </div>

                    <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 100%;">

                        <h4>Mode of Delivery</h4>
                            <div class="form-check form-check-inline">
                            <label for="main-options"><strong>Select an option:</strong></label>
                                <select class="form-control" id="main-options" required name="shipping_method" style="width: 500px">
                                    <option value="">-- Select Delivery Type --</option>
                                    <option value="In-house Delivery">In-house Delivery (Selected Areas in Metro Manila only)</option>
                                    <option value="Victory Liner Drop & Go and other bus cargo">Victory Liner Drop & Go and other bus cargo (Luzon Area)</option>
                                    <option value="Capex">Capex</option>
                                    <option value="AP Cargo">AP Cargo</option>
                                    <option value="Jades Cargo">Jades Cargo</option>
                                    <option value="Seastar Cargo">Seastar Cargo</option>
                                </select>
                            </div>
                            <br>
                            
                                <!-- PAYMENTS -->
                       
                        <h4>Mode of Payment</h4>
                            <div class="form-check form-check-inline">
                            <label for="main-options"><strong>Select an option:</strong></label>
                                <select class="form-control cash-payment" id="payment_type" required name="payment_method" style="width: 500px">
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
                    <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 100%;">
                    
                            <h4 class="tertiary">Remarks:</h4>
                        <textarea class="form-control" style="width: 500px" id="input" name="remarks" rows="10" cols="50" maxlength="300" placeholder="Enter your remarks here."></textarea><br>    
                                <input type="submit" class="btn btn-warning me-5" name="add_order" value="Confirm Order">

                    </form>

                </div>

        </main>
    </div>
</div>
<script>
    function redirectPage() {
        var selectElement = document.getElementById("orderType");
        var selectedValue = selectElement.value;

            if (selectedValue === "retail") {
                window.location.href = "retail.php";
            }
    }
</script>
<script>
    // Get references to the input fields and the clear button
    var nameInput = document.getElementById('wsname');
    var phoneInput = document.getElementById('wsphone');
    var addressInput = document.getElementById('wsaddress');
    var courierInput = document.getElementById('wscourier');
    var clearButton = document.getElementById('clearButton');

    // Add a click event listener to the clear button
    clearButton.addEventListener('click', function() {
        // Clear the input field values
        nameInput.value = '';
        phoneInput.value = '';
        addressInput.value = '';
        courierInput.value = '';
    });
</script>
<script>
    // Get references to the input fields and the clear button
    var nameInput = document.getElementById('wsname');
    var phoneInput = document.getElementById('wsphone');
    var addressInput = document.getElementById('wsaddress');
    var courierInput = document.getElementById('wscourier');
    var clearButton = document.getElementById('clearButton');

    // Add a click event listener to the clear button
    clearButton.addEventListener('click', function() {
        // Clear the input field values
        nameInput.value = '';
        phoneInput.value = '';
        addressInput.value = '';
        courierInput.value = '';
    });
</script>
<script>
    $(document).ready(function () {

$(document).on('click', '.remove-btn', function () {

    $(this).closest('.dynamicForm').remove();

});

$(document).on('click', '.add-more-form', function () {
    var length = $('.sl').length;
    var i = parseInt(length)+parseInt(1);
    var newrow = $('.add-new-form').append('<div class="container dynamicForm">\
                    <div>\
                        <div class="row">\
                            <input type="hidden" class="form-control sl" name="row[]" value="'+i+'">\
                            <div class="col-md-4">\
                                    <label for="selectedOption"><strong>Product Name</strong></label>\
                                            <select class="form-select" required name="product-name[]" required>\
                                                <option value="">Select an option</option>\
                                                \
                                                <?php while($row = $product->fetch_assoc()){ ?>\
                                                \
                                                <option value="<?php echo $row['product_id'];?>"><?php echo $row['product_name'];?></option>\
                                                \
                                                <?php } ?>\
                                                \
                                            </select>\
                                    </div>\
                            <div class="col-md-3">\
                                <label><strong>Color & Size</strong></label>\
                                <input type="text" class="form-control" placeholder="Color & Size" name="color_size[]">\
                            </div>\
                            <div class="col-md-2">\
                                        <label><strong>Price</strong></label>\
                                        <input type="number" class="form-control" placeholder="Price" name="price[]">\
                            </div>\
                            <div class="col-md-2">\
                                <label><strong>Quantity</strong></label>\
                                <input type="text" class="form-control" placeholder="Quantity" name="quantity[]">\
                             </div>\
                             <div class="col-md-1">\
                                <label><strong>Remove</strong></label>\
                                <button type="button" class="remove-btn btn btn-danger form-control"><i class="fas fa-trash"></i></button>\
                            </div>\
                        </div>\
                    </div>\
                </div>');
});
});
</script>
<script>
    function showPaymentOptions() {
        var paymentType = document.getElementById("payment_type").value;
            if (paymentType == "cash") {
                document.getElementById("cash_options").style.display = "block";
                document.getElementById("installment_options").style.display = "none";
                document.getElementById("otherCards").style.display = "none";
            } else if (paymentType == "installment") {
                document.getElementById("installment_options").style.display = "block";
                document.getElementById("cash_options").style.display = "none";
            } else {
                document.getElementById("cash_options").style.display = "none";
                document.getElementById("installment_options").style.display = "none";
            }
            }
            
            document.getElementById("installment_type").addEventListener("change", function() {
            if (this.value == "otherCards") {
                document.getElementById("otherCards").style.display = "block";
            } else {
                document.getElementById("otherCards").style.display = "none";
            }
        });
</script>