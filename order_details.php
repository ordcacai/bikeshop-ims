<?php

    include('layouts/header.php');

?> 

<?php

include('server/connection.php');

if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])){

    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ? ");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();

    $order_details = $stmt->get_result();

    $order_total_price = calculateTotalOrderPrice($order_details);

}else{

    header('location: account.php');
    exit;

}

function calculateTotalOrderPrice($order_details){

    $total = 0;

    foreach($order_details as $row){

        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];

        $total = $total + ($product_price * $product_quantity);
        
    }   

    return $total;

}

?>

<!-- Order Details -->

<section id="orders" class="orders container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bold text-center">Order Details</h2>
            <hr class="mx-auto">
        </div>

        <table class="mt-5 pt-5 mx-auto">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>

            <?php foreach($order_details as $row){ ?>

                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/imgs/<?php echo $row['product_image']; ?>">
                            <div>
                                <p class="mt-5"><?php echo $row['product_name']; ?></p>
                            </div>
                        </div>
                    </td>

                    <td>
                        <span>₱<?php echo $row['product_price']; ?></span>
                    </td>

                    <td>
                        <span><?php echo $row['product_quantity']; ?></span>
                    </td>
                </tr>
            
            <?php }?>

        </table>

        <?php if($order_status == 'Pending'){?>
            <a href="cancel_order.php" style="float: right;" class="btn btn-danger mt-4">Cancel Order<a href=""></a>
        <?php } ?>

    </section>

    <?php include('layouts/footer.php'); ?>