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

    $stmt4 = $conn->prepare("SELECT * FROM products ORDER BY product_id DESC LIMIT 10");
    $stmt4->execute();
    $products = $stmt4->get_result();//array

?>

<?php include('security.php');
include('sidemenu.php'); ?>

<div class="main-content">
    <div class="container-fluid">
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