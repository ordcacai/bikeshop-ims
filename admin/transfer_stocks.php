<?php
include('header.php');
include('security.php');
include('sidemenu.php');
include('transfer_method.php');
?>

<?php
// Retrieve product options from the database

$stmt = $conn->prepare('SELECT * FROM products');
$stmt->execute();
$product = $stmt->get_result();

// Close the database connection

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

                    <div class="container">
                        <div id="dynamicForm">
                            <div class="row">
                                <div class="col">
                                <label for="selectedOption"><strong>Product Name</strong></label>
                                        <select class="form-select" required name="product-name" required>
                                            <option value="">Select an option</option>
                                            
                                            <?php while($row = $product->fetch_assoc()){ ?>

                                               <option value="<?php echo $row['product_id'];?>"><?php echo $row['product_name'];?></option>

                                            <?php } ?>
                                            
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