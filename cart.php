<?php

    include('layouts/header.php');

?> 

<?php

if(isset($_POST['add_to_cart'])){

    //if this user has already added an item to the cart
    if(isset($_SESSION['cart'])){

        $products_array_ids = array_column($_SESSION['cart'],"product_id"); //return all product id
        //if product has already been added to the cart or not
        if(!in_array($_POST['product_id'], $products_array_ids)){

        $product_id = $_POST['product_id'];
        
            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_color' => $_POST['product_color'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity']
        );

        $_SESSION['cart'][$product_id] = $product_array;

        //product is already in cart
        }else

            echo '<script>alert("Product was already added to the cart");</script>';

    //if this is the first product
    }else{

        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_color = $_POST['product_color'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];
        
        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_color' => $product_color,
            'product_price' => $product_price,
            'product_image' => $product_image,
            'product_quantity' => $product_quantity
        );

        $_SESSION['cart'][$product_id] = $product_array;
        //nested array [1=>[product_array1], 2=>[product_array2],...]
    }

    //Calculate Total
    calculateTotalCart();

//remove item from cart
}else if(isset($_POST['remove_product'])){

    $product_id = $_POST['product_id'];

    unset($_SESSION['cart'][$product_id]);

    //Calcualate Total
    calculateTotalCart();

}else if(isset($_POST['edit_quantity'])){

    //get the id and quantity from the form
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];
    
    //get the product array from the session
    $product_array = $_SESSION['cart'][$product_id];

    //update product quantity
    $product_array['product_quantity'] = $product_quantity;

    //return array back to the session
    $_SESSION['cart'][$product_id] = $product_array;

    //Calcualate Total
    calculateTotalCart();

}else{

    //header('location: index.php');

}


function calculateTotalCart(){

    $total_price = 0;
    $total_quantity = 0;

    foreach($_SESSION['cart'] as $key => $value){

        $product = $_SESSION['cart'][$key];

        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total_price  = $total_price + ($price * $quantity);
        $total_quantity = $total_quantity + $quantity;
    }

    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;

}

?>

    <!-- Cart -->

    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bold">Your Cart</h2>
            <hr>
        </div>

        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>

            <?php if(isset($_SESSION['cart'])){ ?>
                
                <?php foreach($_SESSION['cart'] as $key => $value){?>

                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/imgs/<?php echo $value['product_image']; ?>"/>
                            <div>
                                <p><?php echo $value['product_name']; ?></p>
                                <small><span>₱</span><?php echo $value['product_price']; ?></small>
                                <br>
                                <small><span></span><?php echo $value['product_color']; ?></small>
                                <br>
                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                                    <input type="submit" name="remove_product" class="remove-btn" value="Remove"/>
                                </form>
                            </div>
                        </div>
                    </td>

                    <td>
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                            <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>"/>
                            <input type="submit" name="edit_quantity" class="edit-btn" value="Edit"/>
                        </form>
                    </td>

                    <td>
                        <span>₱</span>
                        <span class="product-price"><?php echo $value['product_quantity'] *  $value['product_price']; ?></span>
                    </td>
                </tr>

                <?php } ?>

            <?php } ?>

        </table>
        <div class="cart-total">
            <table>
                <tr>
                    <td>Total</td>

                        <?php if(isset($_SESSION['cart'])){ ?>

                            <td>₱<?php echo $_SESSION['total']; ?></td>

                        <?php } ?>

                </tr>
            </table>
        </div>
        
        <div class="checkout-container">
            <form method="POST" action="checkout.php">
                <input type="submit" value="Checkout" name="checkout" class="button btn-checkout-btn"/>
            </form>
        </div>
    </section>

    <?php include('layouts/footer.php'); ?>