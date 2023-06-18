<?php
include('header.php');
include('security.php');
include('sidemenu.php');
?>

<?php
// Retrieve product options from the database

$stmt = $conn->prepare('SELECT * FROM stocks');
$stmt->execute();
$stock = $stmt->get_result();

// Close the database connection

?>



<div class="main-content">
    <div class="container-fluid">
        <h1 class="my-4">Inbound</h1>
        <div class="table-responsive">

            <div class="mx-auto container">
                <form method="post" action="process_inbound.php">

                    <div class="form-group mt-2">
                        <label><strong>From</strong></label>
                        <select id="category" class="form-select" required name="location_from">

                            <option value="VMTC">VM Trece</option>
                            <option value="VMSR">VM Sta Rosa</option>
                            <option value="Shopee">Shopee Stocks</option>
                            <option value="Supplier">Supplier</option>

                        </select>
                    </div>

                    <div class="form-group mt-2" style="display: none" id="supplier_name">
                        <label><strong>Supplier Name</strong></label>
                        <input style="width:300px" type="text" class="form-control" name="supplier_name">
                    </div>

                    <div class="form-group mt-2" style="display: none" id="supplier_ref">
                        <label><strong>Reference Number</strong></label>
                        <input style="width:300px" type="text" class="form-control" name="reference_no">
                    </div>

                    <div class="form-group mt-2">
                        <label><strong>To</strong></label>
                        <input style="width:300px" type="text" class="form-control" id="selectedDate" name="location_to" value="VM Main" readonly>
                    </div>

                    <div class="form-group mt-2">
                        <label for="selectedDate"><strong>Inbound Date</strong></label>
                        <input style="width:300px" type="date" class="form-control" id="selectedDate" name="transfer_date" required>
                    </div>
                    <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 100%;">
                    <div style="text-align: left; margin-bottom: 10px;">
                                <input type="button" class="btn btn-primary me-5 my-3" onclick="addRow()" value="Add an Item">
                            </div>
                            
                            <!-- ADD ROW -->
                            <div id="productRows" class="form-group mt-2">
                                <div class="row" id="rowTemplate" style="display: none;">
                                    <div class="col">
                                    <input type="hidden" class="form-control sl" name="row[]" value="<script>var i;</script>">
                                    <label for="itemName">Product Name:</label>
                                    <?php
                                    // Retrieve data from MySQL database
                                        $sql = "SELECT * FROM stocks";
                                        $result = $conn->query($sql);

                                    // Generate dropdown menu with options
                                        echo '<select name="options[]" class="form-control">';
                                        echo '<option value="">--Select Item--</option>'; // Add a placeholder option
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["product_id"] . '">' . $row["product_name"] .' - '. $row["color_size"] . '</option>';
                                        }
                                        }
                                        echo '</select>';

                                    // Close MySQL database connection
                                        $conn->close();
                                    ?>
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
                                <label for="quantity"><strong>Quantity:</strong></label>
                                </div>
                                <div class="col"></div> <!-- Empty column-->
                            </div>

                            <div class="row">
                                <div class="col">&nbsp;</div> <!-- Label with white space -->
                            </div>
                            </div>
                                <input type="hidden" name="transfer_type" value="Inbound">
                                
                        
                    

                    <div class="form-group my-5">
                        <input type="submit" class="btn btn-success me-5" name="record-transfer" value="Record Transfer">
                        <a class="btn btn-danger" href="report_stocks.php">Cancel</a>
                        </div>
                    </div>
                    </div>
                </form>

            </div>

        </div>

<!-- Script to add new row -->
<script>
     function addRow() {
    // Clone the row template
        var length = $('.sl').length;
        var i = parseInt(length)+parseInt(1);
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
<script type="text/javascript">
  $(document).ready(function () {
    $('#category').change(function() {
      if ($(this).val() == 'supplier') {
        $('#supplier_name').show();
        $('#supplier_ref').show();
      } else {
        $('#supplier_name').hide();
        $('#supplier_ref').hide();
      }
    });
  });
</script>