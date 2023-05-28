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
			border-color: blue;
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

<?php include('security.php');
include('sidemenu.php'); ?>

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

                        <h4 class="my-4">Wholesale Information (For Package Label Only)</h4>

                        <div class="form-group mt-2">
                            <label><strong>Name:</strong></label>
                             <input type="text" class="form-control" id="wsname" name="name" placeholder="Ex: Juan Dela Cruz">
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Phone Number:</strong></label><br>
                            <input type="tel" class="form-control" id="wsphone" name="phone" placeholder="Ex: 09*********">
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Address:</strong></label>
                            <textarea class="form-control" id="wsaddress" name="address" placeholder="Ex: 59C. Gen. Ordoñez Ave., Marikina City"></textarea>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Preferred Courier:</strong></label>
                             <input type="text" class="form-control" id="wscourier" name="courier" placeholder="Ex: Lalamove">
                        </div>
                        <br><button type="button" class="btn btn-secondary" style="float: right;" id="clearButton">Clear</button><br><br>
                <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 100%;">

                <h4 class="my-4">Customer Information</h4>
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
                            <label><strong>Location Link:</strong></label><br>
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
                        <input type="text" name="Price[]" class="form-control" maxlength="10" placeholder="Price">
                        </div>
                        
                        <div class="col">
                        <label for="colorSize">Color and Size:</label>
                        <input type="text" name="Color[]" class="form-control" maxlength="50" placeholder="Color and Size">
                        </div>
                        
                        <div class="col">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="Quantity[]" class="form-control" maxlength="3" placeholder="Quantity">
                        </div>
                        
                        <div class="col"></div> <!-- Empty column for spacing -->
                    </div>

                    <div class="row">
                        <div class="col">
                        <label for="itemName">Item Name:</label>
                        </div>
                        <div class="col">
                        <label for="price">Price:</label>
                        </div>
                        <div class="col">
                        <label for="colorSize">Color and Size:</label>
                        </div>
                        <div class="col">
                        <label for="quantity">Quantity:</label>
                        </div>
                        <div class="col"></div> <!-- Empty column for spacing -->
                    </div>
                    </div>

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




                        
                <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 100%;">
                        <div class="form-group my-5">
                            <input type="submit" class="btn btn-warning me-5" name="add_product" value="Confirm Order">
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

    document.getElementById('clearButton').addEventListener('click', function() {
        document.getElementById('wsname').value = '';
        document.getElementById('wsphone').value = '';
        document.getElementById('wsaddress').value = '';
        document.getElementById('wscourier').value = '';
    })
//Script to add row

</script>