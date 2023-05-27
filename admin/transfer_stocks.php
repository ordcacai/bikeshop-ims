<?php 
include('header.php');
?>

<?php include('security.php');
include('sidemenu.php'); ?>
<div class="main-content">
        <div class="container-fluid">
            <h1 class="my-4">Transfer Stocks</h1>
            <table id="addProductsTable" style="width: 55%; border-collapse: collapse; ">
                <tr>
                    <th style="padding: 10px;">Item Name:</th>
                    <th style="padding: 10px;">From:</th>
                    <th style="padding: 10px;">To:</th>
                    <th style="padding: 10px;">Quantity:</th>
                    <th style="padding: 10px;">Color & Size:</th>
                </tr>
                <tr>
                
                <td style="padding: 10px;">
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

   
</div>