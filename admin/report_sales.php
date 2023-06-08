<?php include('header.php'); ?>

<?php
if (!isset($_SESSION['logged_in'])) {
    header('location: ../login.php');
    exit;
}
?>

<?php
// 1. Determine page number
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}

// 2. Return number of records
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM orders");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

// 3. Records per page
$total_records_per_page = 5;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$total_no_of_pages = ceil($total_records / $total_records_per_page);

// 4. Get sales records
$stmt2 = $conn->prepare("SELECT orders.order_date, order_items.product_name, order_items.product_price, order_items.product_quantity, (order_items.product_price - products.product_bp) * order_items.product_quantity AS total_cost, orders.shipping_method, products.product_bp, ((order_items.product_price - products.product_bp) * order_items.product_quantity) AS gross_income
FROM orders
INNER JOIN order_items ON orders.order_id = order_items.order_id
INNER JOIN products ON order_items.product_id = products.product_id
ORDER BY orders.order_date DESC
LIMIT $offset, $total_records_per_page");
$stmt2->execute();
$sales = $stmt2->get_result(); // Array
?>

<link rel="stylesheet" type="css/text" href="../assets/css/admin_style.css">

<?php include('security.php');
include('sidemenu.php'); ?>



<div class="main-content">
    <div class="container-fluid">
        <h1 class="my-4">Sales</h1>
        <a class="btn btn-secondary btn mb-5 me-4" style="float:right;" href="print_sales.php"><i class="fas fa-print"></i> Print</a>

        <div class="row">
            <div class="col-md-12">
                <form action="" method="POST" class="d-flex justify-content-center align-items-center mb-4">
                    <div class="form-group mx-2">
                        <label for="start_date">Start Date:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>">
                    </div>
                    <div class="form-group mx-2">
                        <label for="end_date">End Date:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>">
                    </div>
                    <div class="form-group mx-2">
                        <button type="submit" name="apply" class="btn btn-primary">Apply</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order Date</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Total Cost</th>
                        <th>Shipping Method</th>
                        <th>Gross Income</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $sales->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['order_date']; ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['product_price']; ?></td>
                            <td><?php echo $row['product_quantity']; ?></td>
                            <td><?php echo $row['total_cost']; ?></td>
                            <td><?php echo $row['shipping_method']; ?></td>
                            <td><?php echo $row['gross_income']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <?php if (isset($_POST['apply'])) { ?>
            <div class="total-gross-income">
                <strong style="alighnment: center; size: 25px; color: darkorange; font-weight: bold; text-decoration: underline;">Total Gross Income: <?php echo "₱" . calculateTotalGrossIncome($conn, $_POST['start_date'], $_POST['end_date']); ?></strong>
            </div>
        <?php } ?>
        <nav aria-label="Page navigation example" class="text-center">
            <ul class="pagination mt-5 justify-content-center">
                <li class="page-item <?php if ($page_no <= 1) {
                                            echo 'disabled';
                                        } ?>">
                    <a class="page-link" <?php if ($page_no > 1) {
                                                echo "href='?page_no=$previous_page'";
                                            } ?>>Previous</a>
                </li>

                <?php
                if ($total_no_of_pages <= 10) {
                    for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                        if ($counter == $page_no) {
                            echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                        } else {
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                        }
                    }
                } elseif ($total_no_of_pages > 10) {
                    if ($page_no <= 4) {
                        for ($counter = 1; $counter < 8; $counter++) {
                            if ($counter == $page_no) {
                                echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                            }
                        }
                        echo "<li class='page-item'><a class='page-link'>...</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                    } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                        echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                        echo "<li class='page-item'><a class='page-link'>...</a></li>";
                        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                            if ($counter == $page_no) {
                                echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                            }
                        }
                        echo "<li class='page-item'><a class='page-link'>...</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                    } else {
                        echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                        echo "<li class='page-item'><a class='page-link'>...</a></li>";

                        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                            if ($counter == $page_no) {
                                echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                            }
                        }
                    }
                }
                ?>

                <li class="page-item <?php if ($page_no >= $total_no_of_pages) {
                                            echo 'disabled';
                                        } ?>">
                    <a class="page-link" <?php if ($page_no < $total_no_of_pages) {
                                                echo "href='?page_no=$next_page'";
                                            } ?>>Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<?php
function calculateTotalGrossIncome($conn, $start_date = null, $end_date = null)
{
    
        if ($start_date === null || $end_date === null) {
            return 0; // Return 0 or any other default value when the dates are not provided
        }
    
    $stmt = $conn->prepare("SELECT SUM(order_items.product_price * order_items.product_quantity) AS total_income
                            FROM orders
                            INNER JOIN order_items ON orders.order_id = order_items.order_id
                            WHERE orders.order_date >= ? AND orders.order_date <= ?");
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $stmt->bind_result($total_income);
    $stmt->store_result();
    $stmt->fetch();
    $stmt->close();

    return $total_income;
}
?>

<style>
        .total-gross-income {
        margin-top: 30px;
        background-color: #f5f5f5;
        padding: 10px;
        text-align: center;
    }

    .total-gross-income{
        size: 40px;
        color: darkorange;
        font-weight: bold;
        text-decoration: underline;
    }
</style>