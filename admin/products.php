<?php include('header.php'); ?>

<?php include('security.php');
include('sidemenu.php'); ?>

<link rel="stylesheet" type="text/css" href="admin_style.css">

<div class="main-content">
    <div class="container-fluid">
        <h1 class="my-4">Sales</h1>

        <div class="search-container">
            <input type="text" id="search-bar" placeholder="Search">
            <button type="button" id="refresh-btn">Refresh</button>
        </div>

        <table class="sales-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>QTY</th>
                    <th>Total Cost</th>
                    <th>MOP</th>
                    <th>Base</th>
                    <th>Gross Income</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch sales data from the database and populate the table
                include('../server/connection.php');
                $sql = "SELECT * FROM sales LIMIT 5"; // Change the query to fetch sales data from your database
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Display each row of sales data in the table
                        echo "<tr>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['product_name'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>" . $row['qty'] . "</td>";
                        echo "<td>" . $row['total_cost'] . "</td>";
                        echo "<td>" . $row['mop'] . "</td>";
                        echo "<td>" . $row['base'] . "</td>";
                        echo "<td>" . $row['gross_income'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No sales data found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="pagination">
            <button type="button" class="page-btn">Previous</button>
            <span class="page-number">1</span>
            <button type="button" class="page-btn">Next</button>
        </div>
    </div>
</div>
