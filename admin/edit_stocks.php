<?php include('header.php'); ?>

<?php


if(isset($_GET['stock_id'])){

    $stock_id = $_GET['stock_id'];
    $stmt = $conn->prepare("SELECT * FROM stocks WHERE stock_id=?");
    $stmt->bind_param('i', $stock_id);
    $stmt->execute();
    $stocks = $stmt->get_result();//array

}else if(isset($_POST['edit_btn'])){

    $stock_id = $_POST['stock_id'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("UPDATE stocks SET quantity = ? WHERE stock_id = ?");
    $stmt->bind_param('ii', $quantity, $stock_id);
    $stmt->execute();

    if($stmt->execute()){

        header('location: report_stocks.php?edit_success_message=Product quantity has been updated successfully!');
        
    }else{

        header('location: report_stocks.php?edit_failure_message=Error occured, Please try again.');

    }

}else{

    header('location: report_stocks.php');
    exit;
}


?>

<?php include('security.php');
include('sidemenu.php'); ?>



<div class="main-content">
    <div class="container">
            <h1 class="form-weight-bold my-4">Edit Products</h1>

                    <form id="edit-form" method="POST" action="edit_stocks.php">
                        <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>

                        <?php foreach($stocks as $row){ ?>

                        <input type="hidden" value="<?php echo $row['stock_id']; ?>" name="stock_id">
                        <div class="form-group mt-2">
                            <label><strong>Stock ID</strong></label>
                            <p><?php echo $row['stock_id']; ?></p>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Product ID</strong></label>
                            <p><?php echo $row['product_id']; ?></p>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Product Name</strong></label>
                            <p><?php echo $row['product_name']; ?></p>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Color & Size</strong></label>
                            <p><?php echo $row['color_size']; ?></p>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Quantity</strong></label>
                            <input type="number" class="form-control" name="quantity" value="<?php echo $row['quantity']; ?>">
                        </div>
                        
                        <div class="form-group mt-5">
                            <input type="submit" class="btn btn-primary" name="edit_btn" value="Save">
                            <input type="submit" class="btn btn-danger" name="cancel_btn" value="Cancel">
                        </div>
                        <?php } ?>

                    </form>
    </div>
</div>

