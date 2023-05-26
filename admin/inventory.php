<?php include('header.php'); ?>

<?php
    if(!isset($_SESSION['logged_in'])){
        header('location: ../login.php');
        exit;
    }
?>

<?php

// Determine page number
$page_no = isset($_GET['page_no']) ? $_GET['page_no'] : 1;

// Return the total number of records for the selected category
$category = isset($_GET['category']) ? $_GET['category'] : 'Ebike';
$category_condition = '';

if ($category === 'Ebike') {
    $category_condition = "WHERE product_category = 'Ebike'";
} else if ($category === 'bicycles') {
    $category_condition = "WHERE product_category = 'Bike'";
} else if ($category === 'parts_accessories') {
    $category_condition = "WHERE product_category = 'parts'";
}

// Count the total number of records
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products $category_condition");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

// Default values
$total_records_per_page = 5;
$total_no_of_pages = ceil($total_records / $total_records_per_page);

// Validate and adjust page number if out of range
$page_no = max(1, min($page_no, $total_no_of_pages));

// Calculate the offset
$offset = ($page_no - 1) * $total_records_per_page;

// Get products based on category and pagination
$category_condition = "";
$params = array($offset, $total_records_per_page);

if ($category === 'Ebike') {
    $category_condition = "WHERE product_category = 'Ebike'";
} else if ($category === 'bicycles') {
    $category_condition = "WHERE product_category = 'Bike'";
} else if ($category === 'parts_accessories') {
    $category_condition = "WHERE product_category = 'parts'";
}

$query = "SELECT * FROM products $category_condition LIMIT ?, ?";
$stmt2 = $conn->prepare($query);
$stmt2->bind_param("ii", ...$params);
$stmt2->execute();
$products = $stmt2->get_result();

?>
<?php include('sidemenu.php'); ?>

<div class="main-content">
        <div class="container-fluid">
            <h1 class="my-4">Inventory</h1>

           <!--Tab Menu -->
           <div class="d-flex justify-content-left mb-4">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link <?= ($category === 'Ebike' || $category === '') ? 'active' : ''; ?>" href="?category=Ebike&page_no=<?= $page_no ?>">Ebikes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($category === 'bicycles') ? 'active' : ''; ?>" href="?category=bicycles&page_no=<?= $page_no ?>">Bicycles</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($category === 'parts_accessories') ? 'active' : ''; ?>" href="?category=parts_accessories&page_no=<?= $page_no ?>">Parts & Accessories</a>
        </li>
    </ul>
</div>

            <?php if(isset($_GET['edit_success_message'])){ ?>
                <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message']; ?></p>
            <?php }?>

                <?php if(isset($_GET['edit_success_message'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['edit_failure_message'])){ ?>
                    <p class="text-center" style="color: red;"><?php echo $_GET['edit_failure_message']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['delete_success_message'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['delete_success_message']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['delete_failure_message'])){ ?>
                    <p class="text-center" style="color: red;"><?php echo $_GET['delete_failure_message']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['product_created'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['product_created']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['product_failed'])){ ?>
                    <p class="text-center" style="color: red;"><?php echo $_GET['product_failed']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['images_updated'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['images_updated']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['images_failed'])){ ?>
                    <p class="text-center" style="color: red;"><?php echo $_GET['images_failed']; ?></p>   
                <?php }?>

            
                
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product ID</th>
                            <th scope="col">SRP</th>
                            <th scope="col">WSP</th>
                            <th scope="col">QTY</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php foreach($products as $product) { ?>
    <tr>
        <td><a href="product_details.php?product_id=<?php echo $product['product_id']; ?>"><?php echo $product['product_name']; ?></a></td>
        <td><?php echo $product['product_id']; ?></td>
        <td><?php echo "₱".$product['product_price']; ?></td>
        <td><?php echo "₱".$product['product_special_offer']; ?></td>
        <td><?php echo $product['product_quantity']; ?></td>
    </tr>
<?php } ?>



                    </tbody>
                </table>

                   <!-- Add Product button -->
    <div class="text-center mt-4">
        <a href="add_product.php" class="btn btn-primary">Add Product</a>
    </div>
</div>

                <nav aria-label="Page navigation example" class="text-center">
                    <ul class="pagination mt-5 justify-content-center">
                        <li class="page-item">
                            <a class="page-link <?= ($page_no <= 1) ? 'disabled' : ''; ?> " <?= ($page_no > 1) ? 'href="?category=' . $category . '&page_no=' .$previous_page : ''; ?>>Previous</a>
                        </li>

                        <li class="page-item"><a href="?category=<?= $category ?>&page_no=1" class="page-link">1</a></li>
                        <li class="page-item"><a href="?category=<?= $category ?>&page_no=2" class="page-link">2</a></li>

                        <?php if ($page_no >= 3) { ?>
                            <li class="page-item"><a href="#" class="page-link">...</a></li>
                            <li class="page-item"><a href="?category=<?= $category ?>&page_no=<?= $page_no; ?>" class="page-link"><?= $page_no; ?></a></li>
                        <?php } ?>

                        <li class="page-item">
                            <a class="page-link <?= ($page_no >= $total_no_of_pages) ? 'disabled' : ''; ?> " <?= ($page_no < $total_no_of_pages) ? 'href="?category=' . $category . '&page_no=' .$next_page : ''; ?>>Next</a>
                        </li>
                    </ul>
                </nav>


                <div class="p-10">
                    <strong>Page <?= $page_no; ?> of <?= $total_no_of_pages ?></strong>
                </div>

            </div>
        </main>


    </div>
</div> 

