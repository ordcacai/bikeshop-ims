<?php
include('header.php');
include('security.php');
include('sidemenu.php');
include('transfer_method.php');
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
                <form method="post" action="transfer_stocks.php">

                    <div class="form-group mt-2">
                        <label><strong>From</strong></label>
                        <select class="form-select" required name="location_from">

                            <option value="vmtc">VM Trece</option>
                            <option value="vmsr">VM Sta Rosa</option>
                            <option value="vmmain">VM Main</option>
                            <option value="shopee">Shopee Stocks</option>

                        </select>
                    </div><br>

                    <div class="form-group mt-2">
                        <label><strong>To</strong></label>
                        <select class="form-select" required name="location_to">

                            <option value="vmtc">VM Trece</option>
                            <option value="vmsr">VM Sta Rosa</option>
                            <option value="vmmain">VM Main</option>
                            <option value="shopee">Shopee Stocks</option>

                        </select>
                    </div><br>

                    <div class="form-group mt-2">
                        <label for="selectedDate"><strong>Transfer Date</strong></label>
                        <input style="width:300px" type="date" class="form-control" id="selectedDate" name="transfer_date" required>
                    </div><br>

                    <button type="button" class="btn btn-primary" id="add">Add</button>

                    <div class="container">
                        <div id="dynamicForm">
                            <div class="row">
                                <div class="col">
                                    <label for="selectedOption"><strong>Product Name</strong></label>
                                </div>
                                <div class="col">
                                    <label><strong>Color & Size</strong></label>
                                </div>
                                <div class="col">
                                    <label><strong>Quantity</strong></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" id="name"></div>
                                <div class="col" id="color"></div>
                                <div class="col" id="quantity"></div>
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