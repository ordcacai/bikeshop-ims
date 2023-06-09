<?php include('header.php'); ?>

<?php include('sidemenu.php'); ?>

<div class="main-content">
    <div class="container-fluid">
            <h1 class="my-4">Add Orders</h1>
                <div class="mx-auto container">
                <h2 class="my-4">Order Information</h2>
                
                <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 100%;">
                    <form method="POST" enctype="multipart/form-data" action="testcreate_order_wholesale.php">
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
                                    <option value="For Delivery">For Delivery/Ship out</option>
                                    <option value="Delivered">Delivered</option>
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
                        <h4 class="my-4">Add Products</h4>
                            <div style="text-align: left; margin-bottom: 10px;">
                                <input type="button" class="btn btn-secondary me-5" onclick="addRow()" value="Add an Item">
                            </div>
                            
                            <!-- ADD ROW -->
                            <div id="productRows" class="form-group mt-2">
                                <div class="row" id="rowTemplate" style="display: none;">
                                    <div class="col">
                                    <label for="itemName">Item Name:</label>
                                    <?php
                                    // Retrieve data from MySQL database
                                        $sql = "SELECT product_id, product_name FROM products";
                                        $result = $conn->query($sql);

                                    // Generate dropdown menu with options
                                        echo '<select name="options[]" class="form-control">';
                                        echo '<option value="">--Select Item--</option>'; // Add a placeholder option
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["product_id"] . '">' . $row["product_name"] . '</option>';
                                        }
                                        }
                                        echo '</select>';

                                    // Close MySQL database connection
                                        $conn->close();
                                    ?>
                                    </div>

                                    <div class="col">
                                        <label for="price">Price:</label>
                                            <input type="number" name="Price[]" class="form-control" maxlength="10" placeholder="Price"><br>
                                    </div>
                                
                                    <div class="col">
                                        <label for="colorSize">Color and Size:</label>
                                            <input type="text" name="Color[]" class="form-control" maxlength="50" placeholder="Color and Size"><br>
                                    </div>
                                
                                    <div class="col">
                                        <label for="quantity">Quantity:</label>
                                            <input type="number" name="Quantity[]" class="form-control" maxlength="3" placeholder="Quantity"><br>
                                    </div>
                                
                                    <div class="col">
                                        <div class="input-group">
                                            <button type="button" class="btn btn-danger" onclick="deleteRow(this)">Delete</button><br>
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
    function addRow() {
    // Clone the row template
        var newRow = document.querySelector("#rowTemplate").cloneNode(true);
        newRow.style.display = "flex"; // Show the cloned row

    // Remove labels for the subsequent rows
        var labels = newRow.querySelectorAll("label");
        labels.forEach(function(label) {
        label.parentNode.removeChild(label);
        });

    // Move the delete button to the right side of the row
        var deleteButton = newRow.querySelector(".col:last-child");
        newRow.removeChild(deleteButton);
        newRow.appendChild(deleteButton);

    // Append the cloned row to the container
        document.getElementById("productRows").appendChild(newRow);
        }

    function deleteRow(button) {
        var row = button.closest(".row");
            row.parentNode.removeChild(row);
    }
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