<?php 
include('header.php');
?>
<?php include('security.php');
include('sidemenu.php'); ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_name = $_POST["name"];
    $location_from = $_POST["location_from"];
    $location_to = $_POST["location_to"];
    $quantity = $_POST["quantity"];
    $color_size = $_POST["color_size"];
    $transfer_date = $_POST["transfer_date"];
    

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO stock_transfer (product_name, location_from, location_to, 
        quantity, color_size, transfer_date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiss", $product_name, $location_from, $location_to, $quantity,
        $color_size, $transfer_date);
    
    if ($stmt->execute()) {
        echo "Stock transfer recorded successfully.";
    } else {
        echo "Error recording stock transfer: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}
?>

<?php

// Retrieve options from the database
$sql = "SELECT product_id, product_name FROM products";
$result = $conn->query($sql);

// Array to store options
$options = array();

if ($result->num_rows > 0) {
    // Loop through the result and store options in the array
    while ($row = $result->fetch_assoc()) {
        $options[$row['product_id']] = $row['product_name'];
    }
} else {
    echo "No options found.";
}

// Close the database connection
$conn->close();
                          
?>



<div class="main-content">
    <div class="container-fluid">
            <h1 class="my-4">Transfer Stocks</h1>
            <div class="table-responsive">

                <div class="mx-auto container">
                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

                        <div class="form-group mt-2">
                            <label><strong>From</strong></label>
                            <select class="form-select" required name="from">

                                <option value="supplier">Supplier</option>
                                <option value="vmtc">VM Trece</option>
                                <option value="vmsr">VM Sta Rosa</option>
                                <option value="shopee">Shopee Stocks</option>

                            </select>
                        </div><br>

                        <div class="form-group mt-2">
                            <label><strong>To</strong></label>
                            <select class="form-select" required name="to">

                                <option value="supplier">Supplier</option>
                                <option value="vmtc">VM Trece</option>
                                <option value="vmsr">VM Sta Rosa</option>
                                <option value="vmmain">VM Main</option>
                                <option value="shopee">Shopee Stocks</option>

                            </select>
                        </div><br>

                        <div class="form-group mt-2">
                            <label for="selectedDate"><strong>Transfer Date</strong></label>
                            <input type="date" class="form-control" id="selectedDate" name="transfer-date" required>
                        </div><br>

                        <button type="button" class="btn btn-primary" onclick="addRow()">Add</button>

                        <div class="container">
                            <div id="dynamicForm">
                                <div class="row">
                                    <div class="col">
                                        <label for="selectedOption"><strong>Product Name</strong></label>
                                        <select class="form-select" name="product-name" required>
                                            <option value="">Select an option</option>
                                            <?php
                                            // Output the options as dropdown options
                                            foreach ($options as $id => $name) {
                                                echo "<option value=\"$id\">$name</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col">
                                        <label><strong>Color & Size</strong></label>
                                        <input type="text" class="form-control" placeholder="Color & Size" name="color-size">
                                    </div>

                                    <div class="col">
                                        <label><strong>Quantity</strong></label>
                                        <input type="text" class="form-control" placeholder="Quantity" name="quantity">

                                     </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="form-group my-3">
                            <input type="submit" class="btn btn-primary me-5" name="record-transfer" value="Record Transfer">
                            <a class="btn btn-danger" href="inventory.php">Cancel</a>
                        </div>

                    </form>

                </div>

            </div>

        </main>
    </div>
</div>

<!-- Script to add new row -->
<script>
    function addRow() {
        var form = document.getElementById("dynamicForm");
        var row = form.firstElementChild.cloneNode(true);
        form.appendChild(row);
    }
</script>





