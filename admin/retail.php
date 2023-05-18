<?php include('header.php'); ?>
<style>
		textarea {
			margin-left: 50px;
            height: 5em;
		}
        .button {
            display: inline-block;
            background-color: #f9881c;
            border: 2px solid #f9881c;
            border-radius: 12px;
            padding: 10px 20px;
            margin-right: 10px;
            font-size: 20px;
            font-weight: bold;
            color: #000;
            text-decoration: none;
            text-align: center;
            box-shadow: 2px 2px 2px #888888;
        }
        .button:hover {
            background-color: #fca02f;
            border-color: #fca02f;
            color: #fff;
        }
        .addButton {
            display: inline-block;
            background-color: #f9881c;
            border: 2px solid #f9881c;
            border-radius: 5px;
            padding: 10px 20px;
            margin-right: 10px;
            font-size: 15px;
            font-weight: bold;
            color: #000;
            text-decoration: none;
            text-align: center;
            box-shadow: 2px 2px 2px #888888;
        }
        .addButton:hover {
            background-color: #fca02f;
            border-color: #fca02f;
            color: #fff;
        }
        .outermode {
            width: 1000px;
        }

        .innermode {
            margin-left: 50px;
        }
        select {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 8px 12px;
            font-size: 16px;
            color: #555;
            background-color: #fff;
            width: 200px;
        }

        select:hover {
            background-color: #f2f2f2;
        }
        input[type=text], input[type=tel], input[type=url], textarea {
			padding: 12px 20px;
			margin: 8px 0;
			box-sizing: border-box;
			border: none;
			border-bottom: 2px solid grey;
			border-radius: 4px;
			transition: border-color 0.3s ease-in-out;
			width: 30%; /* set width to 50% for all input fields */
		}

		input[type=text]:hover, input[type=tel]:hover, input[type=url]:hover, textarea:hover {
			border-color: #f9881c;
		}
		/* set width to 50% for the textarea field */
		textarea {
			width: 30%;
		}
</style>
<?php
    if(!isset($_SESSION['admin_logged_in'])){
        header('location: login.php');
        exit;
    }
?>

<?php include('sidemenu.php'); ?>

<div class="main-content">
    <div class="container-fluid">
            <h1 class="my-4">Add New Order</h1>
            <h3 class="tertiary">Order Type </h3>
            <h4> RETAIL | <a href="wholesale.php" id="switch">Switch to WHOLESALE</a></h4>
            <hr style="height: 15px; border: none; color: #000; background-color: #000; width: 60%;">
            <h3 class="tertiary">Order Details</h3>
        <form method="POST" enctype="multipart/form-data" action="create_order.php">
    <form method="POST" enctype="multipart/form-data" action="create_order.php"> 
                <label>Name:</label><br>
                <input type="text" id="user_name" name="name" required placeholder="Ex: Juan Dela Cruz"><br>

                <label>Contact Number:</label><br>
                <input type="tel" id="user_phone" name="phone" required placeholder="Ex: 09*********"><br>

                <label>Address:</label><br>
                <input type="text" id="user_address" name="address" required placeholder="Ex: 59C. Gen. Ordoñez Ave., Marikina City"><br>

                <label>Nearest Landmark:</label><br>
                <input type="text" id="user_landmark" name="landmark" placeholder="Ex: Manila Post Office"><br>

                <label>Location Link:</label><br>
                <input type="text" id="location_link" name="location" placeholder="Ex: https://ul.waze.com/ul?ll=69"><br>
            <!-- </form> -->
            
            <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 60%;">
            <br><h3 class="tertiary">Add Products</h3>
            <table id="addProductsTable" style="width: 55%; border-collapse: collapse; ">
                <tr>
                    <th style="padding: 10px;">Item Name:</th>
                    <th style="padding: 10px;">Price:</th>
                    <th style="padding: 10px;">Color:</th>
                    <th style="padding: 10px;">Size:</th>
                    <th style="padding: 10px;">Quantity:</th>
                </tr>
                <tr>
                <div style="text-align:left; margin-bottom:10px;">
                    <button class="addButton" onclick="addRow()">Add an Item</button>
                </div>
                <!-- <form method="POST" enctype="multipart/form-data" action="create_order.php"> -->
                <td style="padding: 10px;" required name="product_name">
                    <?php
                    // Retrieve data from MySQL database
                    $sql = "SELECT product_id, product_name FROM products";
                    $result = $conn->query($sql);

                    // Generate dropdown menu with options
                    echo '<select name="options[]">';
                    echo '<option value="">--Select Item--</option>'; // Add placeholder option
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["product_id"] . '">' . $row["product_name"] . '</option>';
                        }
                    }
                    echo '</select>'; 

                    // Close MySQL database connection
                    $conn->close();
                    ?>
                </td>
                <td style="padding: 10px;"><input type="text" name="Price[]" style="width: 150px" maxlength="10"></td>
                <td style="padding: 10px;"><input type="text" name="Color[]" style="width: 150px"maxlength="20"></td>
                <td style="padding: 10px;"><input type="text" name="Size[]" style="width: 150px" maxlength="10"></td>
                <td style="padding: 10px;"><input type="text" name="Quantity[]" style="width: 150px" maxlength="3"></td>
            </tr>
        </table>
                <!-- </form> -->
        <!-- Script to add new row -->
        <script>
            function addRow() {
                // Retrieve table element
                var table = document.getElementsByTagName('table')[0];

                // Create new row element
                var newRow = document.createElement('tr');

                // Copy second row content to new row
                newRow.innerHTML = table.rows[1].innerHTML;

                // Create delete button and append to new row
                var deleteButton = document.createElement('button');
                deleteButton.innerText = 'Delete';
                deleteButton.onclick = function() {
                    this.parentNode.parentNode.remove();
                }
                var deleteCell = newRow.insertCell(-1);
                deleteCell.appendChild(deleteButton);

                // Append new row to table
                table.appendChild(newRow);
            }
        </script>
              
            </table>
            <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 60%;">
        <br><h3 class="tertiary">Payment and Shipment</h3>
        <!-- <form method="POST" enctype="multipart/form-data" action="create_order.php"> -->
            <br>
            <h4>Mode of Delivery</h4>
            <label for="main-options">Select an option:</label>
            <select id="main-options" required name="main-options" onchange="showSubOptionsOrTextBox()" style="width: 500px">
                <option value="">-- Select Delivery Type --</option>
                <option value="option1">In-house Delivery (Selected Areas in Metro Manila only)</option>
                <option value="option2">Freight (Select for Specific Cargo Options)</option>
                <option value="option3">Victory Liner Drop & Go and other bus cargo (Luzon Area)</option>
                <option value="option4">Others</option>
            </select>
            <br>
            <div id="sub-options-container" style="display:none;">
                <label>Courier:</label>
                <select id="shipping_method" required name="shipping_method">
                    <option value="">-- Select Courier --</option>
                    <option value="sub-option1">Capex</option>
                    <option value="sub-option2">AP Cargo</option>
                    <option value="sub-option3">Jades Cargo</option>
                    <option value="sub-option4">Seastar Cargo</option>
                </select>
            </div>
            
            <div id="text-box-container" style="display:none;">
                <label for="text-box">Please specify:</label>
                <input type="text" id="deliveryOption_others" name="text-box">
            </div>

        <!-- </form> -->
        
        <script>
            function showSubOptionsOrTextBox() {
                var mainOptions = document.getElementById("main-options");
                var subOptionsContainer = document.getElementById("sub-options-container");
                var textBoxContainer = document.getElementById("text-box-container");

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
        <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 20%;">
        <h4>Mode of Payment</h4>   
        <!-- <form method="POST" enctype="multipart/form-data" action="create_order.php"> -->
            <label>Payment Type:</label>
            <select id="payment_type" required name="payment_type" onchange="showPaymentOptions()" style="width: 300px">
                <option value="">-- Select Payment Type --</option>
                <option value="cash">Cash Payments</option>
                <option value="installment">Installment Options</option>
            </select>
            
            <div id="cash_options" style="display:none;">
                <label for="cash_method">Cash Method:</label>
                <select id="cash_method" required name="payment_method" style="width: 300px">
                <option value="">-- Select Cash Method --</option>
                <option value="bpi">BPI (Bank Transfer)</option>
                <option value="bdo">BDO (Bank Transfer)</option>
                <option value="gcash">GCash</option>
                <option value="cash">Cash</option>
                <option value="cod">Cash on Delivery</option>
                </select>
            </div>
            
            <div id="installment_options" style="display:none;">
                <label for="installment_type">Installment Type:</label>
                <select id="installment_type" required name="payment_method"  style="width: 250px">
                <option value="">-- Select Installment Type --</option>
                <option value="homecredit">Home Credit</option>
                <option value="billease">BillEase</option>
                <option value="billease">Cashalo</option>
                <option value="atome">Atome</option>
                <option value="bdocreditcard">Straight Payment (Terminal)</option>
                <option value="bdocreditcard">BDO CC Installment (Terminal)</option>
                <option value="bdocreditcard">BDO Checkout Installment</option>
                <option value="bdocreditcard">Paypal Straight Payment</option>
                </select>
            </div>
            <!-- </form> -->

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

        <br><h3 class="tertiary">Remarks:</h3>
                <!-- <form method="POST" enctype="multipart/form-data" action="create_order.php"> -->
                    <textarea id="input" name="input" rows="10" cols="50" maxlength="300" placeholder="Enter your remarks here."></textarea><br>
                    <label for="orderStatus">Order Status</label>
                        <select id="orderStatus" required name="order_status" style="width: 300px">
                            <option value="">-- Select Order Status --</option>
                            <option value="pending">Pending</option>
                            <option value="forDelivery">For Delivery/Ship Out</option>
                            <option value="delivered">Delivered/Shipped</option>
                            <option value="walkin">Walk-in</option>
                        </select>
                        
    </form>
    <input type="submit" class="button" name="add_order" value="Submit">
        </form>       
                <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 60%;">

    </div>
</div> 

