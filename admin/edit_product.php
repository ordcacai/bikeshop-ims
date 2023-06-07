<?php include('header.php'); ?>

<?php


if(isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $products = $stmt->get_result();//array

}else if(isset($_POST['edit_btn'])){

    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $color = $_POST['color'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    $stmt = $conn->prepare("UPDATE products SET product_name=?, product_price=?, product_special_offer=?, product_color=?, product_description=?, product_category=? WHERE product_id = ?");
    $stmt->bind_param('sssssss', $name, $price, $discount, $color, $description, $category, $product_id);
    $stmt->execute();

    if($stmt->execute()){

        header('location: products.php?edit_success_message=Product has been updated successfully!');
        
    }else{

        header('location: products.php?edit_failure_message=Error occured, Please try again.');

    }

}else{
    header('location: products.php');
    exit;
}


?>

<?php include('security.php');
include('sidemenu.php'); ?>



<div class="main-content">
    <div class="container">
            <h1 class="form-weight-bold my-4">Edit Products</h1>

                    <form id="edit-form" method="POST" action="edit_product.php">
                        <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>

                        <?php foreach($products as $product){ ?>

                        <input type="hidden" value="<?php echo $product['product_id']; ?>" name="product_id">
                        <div class="form-group mt-2">
                            <label><strong>Product Name</strong></label>
                            <input type="text" class="form-control" id="product-name" value="<?php echo $product['product_name']; ?>" name="name" placeholder="Product Name" required>
                        </div>
                        
                        <div class="form-group mt-2">
                            <label><strong>Price</strong></label>
                            <input type="text" class="form-control" id="product-price" value="<?php echo $product['product_price']; ?>" min="1" max="500000" name="price" placeholder="Price" required>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Product Discount</strong></label>
                            <input type="number" class="form-control" id="product-disc" value="<?php echo $product['product_special_offer']; ?>" name="discount" min="1" max="100" placeholder="Discount" required>
                        </div>

                        <!-- <div class="form-group mt-2">
                            <label><strong>Color</strong></label>
                            <input type="text" class="form-control" id="product-color" value="<?php echo $product['product_color']; ?>" name="color" placeholder="Color" required>
                        </div> -->

                        <div class="form-group mt-2">
                            <label><strong>Description</strong></label>
                            <input type="text" class="form-control" id="product-desc" value="<?php echo $product['product_description']; ?>" name="description" placeholder="Description" required>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Category</strong></label>
                            <select class="form-select" required name="category">

                                <option value="Bike" <?php if($product['product_category'] == 'Bike'){echo "selected";} ?>>Bike</option>
                                <option value="parts" <?php if($product['product_category'] == 'parts'){echo "selected";} ?>>Parts & Accessories</option>

                            </select>
                        </div>
                        
                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-primary" name="edit_btn" value="Save">
                            <input type="submit" class="btn btn-danger" name="cancel_btn" value="Cancel">
                        </div>
                        <?php } ?>

                    </form>
    </div>
</div>

