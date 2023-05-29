<?php include('header.php'); ?>

<?php include('sidemenu.php'); ?>

<div class="main-content">
    <div class="container-fluid">
            <h1 class="my-4">Add Orders</h1>
            <div class="table-responsive">
                <div class="mx-auto container">
                <h2 class="my-4">Order Information</h2>
                <h4 class="my-4">Order Type</h4>
                <div class="form-check form-switch" style="display: flex; align-items: center;">
                    <label class="form-check-label" for="disableSwitch" style="margin-right: 55px;">WHOLESALE</label>
                    <input class="form-check-input" type="checkbox" id="disableSwitch" onchange="toggleForm()" style="margin-right: 15px;" />
                    <label class="form-check-label" for="disableSwitch">RETAIL</label>
                </div>
                <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 100%;">
                    <form id="create-form" enctype="multipart/form-data" method="POST" action="create_order.php">
                        <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>

                        <h4 class="my-4">Package Label Information <span class="badge rounded-pill bg-warning text-dark">FOR WHOLESALE ONLY</span></h4>

                        <div class="form-group mt-2">
                            <label><strong>Name:</strong></label>
                             <input type="text" class="form-control" id="wsname" name="wsname" placeholder="Ex: Lalisa Manoban">
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
                            <button type="button" class="btn btn-secondary" style="float: right;" id="clearButton">Clear</button><br>
                        </div><br>
                <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 100%;">

                <h4 class="my-4">Customer Information</h4>
                <label for="orderStatus"><strong>Order Status</strong></label>
                        <select class="form-control" id="orderStatus" name="order_status" style="width: 500px">
                            <option value="">-- Select Order Status --</option>
                            <option value="Pending">Pending</option>
                            <option value="For Delivery">For Delivery/Ship out</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Walk-In">Walk-In</option>
                        </select>
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

                <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 100%;">

                <h4 class="my-4">Add Products</h4>
                    <div style="text-align: left; margin-bottom: 10px;">
                    <input type="button" class="btn btn-secondary me-5" onclick="addRow()" value="Add an Item">
                    </div>
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
                    <label for="main-options"><strong>Select an option:</strong></label>
                    <select class="form-control" id="main-options" name="shipping_method" onchange="showSubOptionsOrTextBox()" style="width: 500px">
                        <option value="">-- Select Delivery Type --</option>
                        <option value="In-house Delivery">In-house Delivery (Selected Areas in Metro Manila only)</option>
                        <option value="option2">Freight (Select for Specific Cargo Options)</option>
                        <option value="Victory Liner Drop & Go and other bus cargo">Victory Liner Drop & Go and other bus cargo (Luzon Area)</option>
                        <option value="Others (Remarks)">Others</option>
                    </select>
                    <br>
                    <div id="sub-options-container" style="display:none;">
                        <label for="sub-options"><strong>Courier:</strong></label>
                        <select class="form-control" id="sub-options" name="shipping_method" style="width: 500px">
                            <option value="">-- Select Courier --</option>
                            <option value="Capex">Capex</option>
                            <option value="AP Cargo">AP Cargo</option>
                            <option value="Jades Cargo">Jades Cargo</option>
                            <option value="Seastar Cargo">Seastar Cargo</option>
                        </select><br>
                    </div>
                    <h4>Mode of Payment</h4>
                    <label for="payment_type"><strong>Payment Type:</strong></label>
                        <select class="form-control" id="payment_type" name="payment_method" onchange="showPaymentOptions()" style="width: 500px">
                            <option value="">-- Select Payment Type --</option>
                            <option value="cash">Cash Payments</option>
                            <option value="installment">Installment Options</option>
                        </select><br>
                        
                        <div id="cash_options" style="display:none;">
                            <label for="cash_method"><strong>Cash Method:</strong></label>
                            <select class="form-control" id="cash_method" name="payment_method" style="width: 500px">
                            <option value="">-- Select Cash Method --</option>
                            <option value="BPI (Bank Transfer)">BPI (Bank Transfer)</option>
                            <option value="BDO (Bank Transfer)">BDO (Bank Transfer)</option>
                            <option value="GCash">GCash</option>
                            <option value="Cash">Cash</option>
                            </select><br>
                        </div>
                        
                        <div id="installment_options" style="display:none;">
                            <label for="installment_type"><strong>Installment Type:</strong></label>
                            <select class="form-control" id="installment_type" name="payment_method"  style="width: 500px">
                            <option value="">-- Select Installment Type --</option>
                            <option value="homecredit">Home Credit</option>
                            <option value="billease">BillEase</option>
                            <option value="atome">Atome</option>
                            <option value="bdocreditcard">BDO Credit Card</option>
                            </select><br>
                        </div>
                <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 100%;">

                <h3 class="tertiary"><strong>Remarks:</strong></h3>
                <form method="post">
                    <textarea class="form-control" style="width: 500px" id="input" name="remarks" rows="10" cols="50" maxlength="300" placeholder="Enter your remarks here."></textarea><br>
                
                        <div class="form-group my-5">
                            <input type="submit" class="btn btn-warning me-5" name="add_order" value="Confirm Order">
                        </div>

                    </form>

                </div>

            </div>

        </main>
    </div>
</div>

<script>
    var input = document.getElementById("myInput");
    var text = input.value;
    var middleIndex = Math.floor(text.length / 2);
    
    input.focus();
    input.setSelectionRange(middleIndex, middleIndex);

    function toggleForm() {
        var switchInput = document.getElementById("disableSwitch");
        var nameField = document.getElementById("wsname");
        var phoneField = document.getElementById("wsphone");
        var addressField = document.getElementById("wsaddress");
        var pcourierField = document.getElementById("wscourier");
        
        nameField.disabled = switchInput.checked;
        phoneField.disabled = switchInput.checked;
        addressField.disabled = switchInput.checked;
        pcourierField.disabled = switchInput.checked;
    }

    
    // Disable form on page load
    window.onload = function() {
        toggleForm();
    };

    
//Script to add row

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
            function showSubOptionsOrTextBox() {
                var mainOptions = document.getElementById("main-options");
                var subOptionsContainer = document.getElementById("sub-options-container");
                var textBoxContainer = document.getElementById("text-box-container");//////////////

                if (mainOptions.value == "option2") {
                    subOptionsContainer.style.display = "block";
                    textBoxContainer.style.display = "none";
                } else if (mainOptions.value == "option4") {
                    subOptionsContainer.style.display = "none";
                    textBoxContainer.style.display = "block";
                } else {
                    subOptionsContainer.style.display = "none";
                    textBoxContainer.style.display = "none";
                }
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