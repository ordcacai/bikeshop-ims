<?php 
include('header.php');
include('security.php');
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

    $prod_name = "SELECT product_id FROM products WHERE product_name = '$product_name'";
    $result = $conn->query($prod_name);

    if ($result->num_rows == 0) {
        // Product name does not match any product ID
        echo "Invalid product selected.";
        exit;
    }

    $sql_subtract = "UPDATE stocks SET quantity = quantity - $quantity WHERE location = '$location_from' AND product_id = (SELECT product_id FROM products WHERE product_name = '$product_name')";
    $sql_add = "UPDATE stocks SET quantity = quantity + $quantity WHERE location = '$location_to' AND product_id = (SELECT product_id FROM products WHERE product_name = '$product_name')";

    // Execute the queries
    $conn->query($sql_subtract);
    $conn->query($sql_add);
}
?>

<?php
// Retrieve product options from the database
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
                    <form method="post" action="<?php echo $_SERVER["REQUES_METHOD"]; ?>">

                        <div class="form-group mt-2">
                            <label><strong>From</strong></label>
                            <select class="form-select" required name="from">

                                <option value="vmtc">VM Trece</option>
                                <option value="vmsr">VM Sta Rosa</option>
                                <option value="vmmain">VM Main</option>
                                <option value="shopee">Shopee Stocks</option>

                            </select>
                        </div><br>

                        <div class="form-group mt-2">
                            <label><strong>To</strong></label>
                            <select class="form-select" required name="to">

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
                                            <option value="">Select a product</option>
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





