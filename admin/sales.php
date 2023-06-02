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
$stmt2 = $conn->prepare("SELECT orders.order_date, order_items.product_name, order_items.product_price, order_items.product_quantity, (order_items.product_price * order_items.product_quantity) AS total_cost, orders.shipping_method, products.product_bp, (order_items.product_price * order_items.product_quantity) AS gross_income
FROM orders
INNER JOIN order_items ON orders.order_id = order_items.order_id
INNER JOIN products ON order_items.product_id = products.product_id
ORDER BY orders.order_date DESC
LIMIT $offset, $total_records_per_page");
$stmt2->execute();
$sales = $stmt2->get_result(); // Array
?>

<?php include('security.php');
include('sidemenu.php'); ?>

<link rel="stylesheet" type="text/css" href="../admin_style.css">

<div class="main-content">
    <div class="container-fluid">
        <h1 class="my-4">Sales</h1>

        <?php if (isset($_GET['edit_success_message'])) { ?>
            <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message']; ?></p>
        <?php } ?>

        <?php if (isset($_GET['edit_failure_message'])) { ?>
            <p class="text-center" style="color: red;"><?php echo $_GET['edit_failure_message']; ?></p>
        <?php } ?>

        <?php if (isset($_GET['delete_success_message'])) { ?>
            <p class="text-center" style="color: green;"><?php echo $_GET['delete_success_message']; ?></p>
        <?php } ?>

        <?php if (isset($_GET['delete_failure_message'])) { ?>
            <p class="text-center" style="color: red;"><?php echo $_GET['delete_failure_message']; ?></p>
        <?php } ?>

        <?php if (isset($_GET['product_created'])) { ?>
            <p class="text-center" style="color: green;"><?php echo $_GET['product_created']; ?></p>
        <?php } ?>

        <?php if (isset($_GET['product_failed'])) { ?>
            <p class="text-center" style="color: red;"><?php echo $_GET['product_failed']; ?></p>
        <?php } ?>

        <?php if (isset($_GET['images_updated'])) { ?>
            <p class="text-center" style="color: green;"><?php echo $_GET['images_updated']; ?></p>
        <?php } ?>

        <?php if (isset($_GET['images_failed'])) { ?>
            <p class="text-center" style="color: red;"><?php echo $_GET['images_failed']; ?></p>
        <?php } ?>

        <form method="post" class="mb-4">
            <div class="form-row align-items-end">
                <div class="col-md-3">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control">
                </div>
                <div class="col-md-2 mt-auto">
                    <button type="submit" name="apply" class="btn btn-primary">Apply</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">QTY</th>
                        <th scope="col">Total Cost</th>
                        <th scope="col">MOP</th>
                        <th scope="col">Base</th>
                        <th scope="col">Gross Income</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sales as $sale) { ?>
                        <tr>
                            <td><?php echo $sale['order_date']; ?></td>
                            <td><?php echo $sale['product_name']; ?></td>
                            <td><?php echo "₱" . $sale['product_price']; ?></td>
                            <td><?php echo $sale['product_quantity']; ?></td>
                            <td><?php echo "₱" . $sale['total_cost']; ?></td>
                            <td><?php echo $sale['shipping_method']; ?></td>
                            <td><?php echo "₱" . $sale['product_bp']; ?></td>
                            <td><?php echo "₱" . $sale['gross_income']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <?php if (isset($_POST['apply'])) { ?>
            <div class="total-gross-income">
                <strong style="size: 25px; color: darkorange; font-weight: bold; text-decoration: underline;">Total Gross Income: <?php echo "₱" . calculateTotalGrossIncome($conn, $_POST['start_date'], $_POST['end_date']); ?></strong>
            </div>
        <?php } ?>

        <?php
        function calculateTotalGrossIncome($conn, $start_date, $end_date)
        {
            $stmt = $conn->prepare("SELECT SUM(order_items.product_price * order_items.product_quantity) AS total_gross_income
            FROM orders
            INNER JOIN order_items ON orders.order_id = order_items.order_id
            WHERE orders.order_date BETWEEN ? AND ?");
            $stmt->bind_param("ss", $start_date, $end_date);
            $stmt->execute();
            $stmt->bind_result($total_gross_income);
            $stmt->fetch();
            $stmt->close();

            return $total_gross_income;
        }
        ?>

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
<style>
    
    .total-gross-income {
        margin-top: 30px;
        background-color: #f5f5f5;
        padding: 10px;
        text-align: center;
    }

    .total-gross-income strong {
        size: 40px;
        color: darkorange;
        font-weight: bold;
        text-decoration: underline;
    }
    </style>


