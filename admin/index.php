<?php include('header.php'); ?>

<?php
    if(!isset($_SESSION['logged_in'])){
        header('location: ../login.php');
        exit;
    }
?>

<?php

    $stmt = $conn->prepare("SELECT COUNT(*) As total_records_users FROM users");
    $stmt->execute();
    $stmt->bind_result($total_records_users);
    $stmt->store_result();
    $stmt->fetch();

?>

<?php

    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records_orders FROM orders");
    $stmt1->execute();
    $stmt1->bind_result($total_records_orders);
    $stmt1->store_result();
    $stmt1->fetch();

?>

<?php

    $stmt2 = $conn->prepare("SELECT COUNT(*) As total_records_products FROM products");
    $stmt2->execute();
    $stmt2->bind_result($total_records_products);
    $stmt2->store_result();
    $stmt2->fetch();

?>

<?php

    $stmt3 = $conn->prepare("SELECT * FROM orders ORDER BY order_id DESC LIMIT 10");
    $stmt3->execute();
    $orders = $stmt3->get_result();//array

?>

<?php

    $stmt4 = $conn->prepare("SELECT * FROM products ORDER BY product_id DESC LIMIT 5");
    $stmt4->execute();
    $products = $stmt4->get_result();//array

?>

<?php

    $stmt5 = $conn->prepare("SELECT product_name, product_id, COUNT(product_id) AS 'TotalRepetitions' FROM order_items GROUP BY product_id ORDER BY 'TotalRepetitions' DESC LIMIT 10");
    $stmt5->execute();
    $order_count = $stmt5->get_result();//array
    $dataPoints = array();
    foreach($order_count as $row){

    array_push($dataPoints, array("y" => $row['TotalRepetitions'], "label" => $row['product_name'] ));

    }
?>

<?php
    $stmt6 = $conn->prepare("SELECT product_name, product_quantity FROM products ORDER BY product_quantity DESC LIMIT 10");
    $stmt6->execute();
    $stocks = $stmt6->get_result();//array
    $dataPoints2 = array();
    foreach($stocks as $row){

    array_push($dataPoints2, array("y" => $row['product_quantity'], "label" => $row['product_name'] ));

    }
?>

<?php include('security.php');
include('sidemenu.php'); ?>

<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## orders",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});

chart.render();

var chart2 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	theme: "light2",
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## stocks",
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});

chart2.render();
 
}
</script>

<div class="main-content">
    <div class="container-fluid mb-5">
            <h1 class="my-4">Dashboard</h1>
                    <div class="cards">
                        <div class="card-single">
                            <div>
                                <h1><?php echo $total_records_users; ?></h1>
                                <span>Customers</span>
                            </div>
                            <div>
                                <span><i class="fas fa-users"></i></span>
                            </div>
                        </div>
                        <div class="card-single">
                            <div>
                                <h1><?php echo $total_records_orders; ?></h1>
                                <span>Orders</span>
                            </div>
                            <div>
                                <span><i class="fas fa-clipboard-list"></i></span>
                            </div>
                        </div>
                        <div class="card-single">
                            <div>
                                <h1><?php echo $total_records_products; ?></h1>
                                <span>Products</span>
                            </div>
                            <div>
                                <span><i class="fas fa-box"></i></span>
                            </div>
                        </div>
                        <div class="card-single">
                            <div>
                                <h1>₱999,999</h1>
                                <span>Income</span>
                            </div>
                            <div>
                                <span><i class="fas fa-wallet"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="recent-grid">  

                        <div class="graph">
                            <div class="card">
                            <div class="card-header">
                                    <h3>Best Selling Products</h3>

                                    <button onclick="window.location.href='products.php';">View All <span><i class="fas fa-eye"></i></span></button>
                                </div>
                                <div id="chartContainer" style="height: 499px; width: 100%;"></div>
                            </div>
                        </div>
                        
                        <div class="orders">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Recent Orders</h3>

                                    <button onclick="window.location.href='orders.php';">View All <span><i class="fas fa-eye"></i></span></button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center" width="100%">
                                            <thead>
                                                <tr>
                                                    <td><strong>Order ID</strong></td>
                                                    <td><strong>Customer Name</strong></td>
                                                    <td><strong>Order Status</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($orders as $order) { ?>
                                                <tr>
                                                    <td><?php echo $order['order_id']; ?></td>
                                                    <td><?php echo $order['user_name']; ?></td>
                                                    <td><?php echo $order['order_status']; ?></td>
                                                </tr>
                                            <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="graph">
                            <div class="card">
                            <div class="card-header">
                                    <h3>Stocks</h3>

                                    <button onclick="window.location.href='products.php';">View All <span><i class="fas fa-eye"></i></span></button>
                                </div>
                                <div id="chartContainer2" style="height: 363px; width: 100%;"></div>
                            </div>
                        </div>

                        <div class="products">
                            <div class="card">
                                    <div class="card-header">
                                        <h3>Newly Added Products</h3>

                                        <button onclick="window.location.href='inventory.php';">View All <span><i class="fas fa-eye"></i></span></button>
                                    </div>
                                    <div class="card-body">
                                    <?php foreach($products as $product) { ?>
                                        <div class="product">
                                            <div class="info">
                                            <img src="<?php echo "../assets/imgs/".$product['product_image']; ?>" style="width: 60px; height: 50px;">
                                                <div>
                                                    <h4><?php echo $product['product_name']; ?></h4>
                                                    <small><?php echo "₱".$product['product_price']; ?></small>
                                                </div>
                                            </div>
                                            <div class="configure">
                                                <a href="product_details.php?product_id=<?php echo $product['product_id']; ?>"><i class="fas fa-eye"></i></a >
                                                <a href="edit_product.php?product_id=<?php echo $product['product_id']; ?>"><i class="fas fa-edit"></i></a >
                                                <a href="delete_product.php?product_id=<?php echo $product['product_id']; ?>"><i class="fas fa-trash"></i></a >
                                            </div>
                                        </div>
                                    <?php } ?>
                                    </div>
                            </div>
                        </div>
                        
                    </div>
            </div>
        </div>

        <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>