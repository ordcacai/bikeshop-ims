<?php include('header.php'); ?>

<?php
    if(!isset($_SESSION['admin_logged_in'])){
        header('location: login.php');
        exit;
    }
?>

<?php

    //1. determine page no.
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        //if user has already entered page then page number is the one that they selected
        $page_no = $_GET['page_no'];
    }else{
        //if user just entered the page then default page is 1
        $page_no = 1;
    }

    //2. return number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products");
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    // 3. Return the total number of records for the selected category
$category = isset($_GET['category']) ? $_GET['category'] : '';
echo "Selected category: " . $category;

if ($category != '') {
    $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products WHERE product_category = ?");
    $stmt1->bind_param("s", $category);
} else {
    $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
}

$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

// Default values
$total_records_per_page = 5;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$total_no_of_pages = ceil($total_records / $total_records_per_page);

/// 4. Get all products
$category = isset($_GET['category']) ? $_GET['category'] : '';
if ($category != '') {
    if ($category === 'parts_accessories') {
        $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category = ? LIMIT ?, ?");
        $stmt2->bind_param("sii", $category, $offset, $total_records_per_page);
    } else {
        $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category = ? LIMIT ?, ?");
        $stmt2->bind_param("sii", $category, $offset, $total_records_per_page);
    }
} else {
    $stmt2 = $conn->prepare("SELECT * FROM products LIMIT ?, ?");
    $stmt2->bind_param("ii", $offset, $total_records_per_page);
}
$stmt2->execute();
$products = $stmt2->get_result();


?>
<div class="container-fluid">
    <div class="row" style="min-height:1000px">
        <?php include('sidemenu.php'); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 mt-2">
                <h1 class="mb-5">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2"></div>
                </div>
            </div>
            <h1 class="mb-4">Inventory</h1>

            <!-- Centered Tab Menu -->
            <div class="d-flex justify-content-center mb-4">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link <?php echo (!isset($_GET['category']) || $_GET['category'] === 'Bike') ? 'active' : ''; ?>" href="?category=bike">Ebikes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($_GET['category'] === 'bicycles') ? 'active' : ''; ?>" href="?category=bicycles">Bicycles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (!isset($_GET['category']) || $_GET['category'] === 'parts_accessories') ? 'active' : ''; ?>" href="?category=parts_accessories">Parts & Accessories</a>
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
                            <th scope="col">Product ID</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Price</th>
                            <th scope="col">Product Discount</th>
                            <th scope="col">Product Category</th>
                            <th scope="col">Product Color</th>
                            <th scope="col">Edit Images</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach($products as $product) { ?>
                        <tr>
                            <td><?php echo $product['product_id']; ?></td>
                            <td><img src="<?php echo "../assets/imgs/".$product['product_image']; ?>" style="width: 70px; height: 70px;"></td>
                            <td><?php echo $product['product_name']; ?></td>
                            <td><?php echo "₱".$product['product_price']; ?></td>
                            <td><?php echo $product['product_special_offer']."%"; ?></td>
                            <td><?php echo $product['product_category']; ?></td>
                            <td><?php echo $product['product_color']; ?></td>
                            <td><a class="btn btn-warning" href="<?php echo "edit_images.php?product_id=".$product['product_id']."&product_name=".$product['product_name'];?>">Edit Images</a></td>
                            <td><a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $product['product_id']; ?>">Edit</a></td>
                            <td><a class="btn btn-danger" href="delete_product.php?product_id=<?php echo $product['product_id']; ?>">Delete</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                    <nav aria-label="Page navigation example" class="text-center">
                    <ul class="pagination mt-5 justify-content-center">
                        <li class="page-item">
                            <a class="page-link <?= ($page_no <= 1) ? 'disabled' : ''; ?> " <?= ($page_no > 1) ? 'href=?page_no=' .$previous_page : ''; ?>>Previous</a>
                        </li>


                        <li class="page-item"><a href="?page_no=1" class="page-link">1</a></li>
                        <li class="page-item"><a href="?page_no=2" class="page-link">2</a></li>

                            <?php if($page_no >= 3) { ?>
                                <li class="page-item"><a href="#" class="page-link">...</a></li>
                                <li class="page-item"><a href="?page_no=<?= $page_no; ?>" class="page-link"><?= $page_no; ?></a></li>
                            <?php } ?>

                        <li class="page-item">
                        <a class="page-link <?= ($page_no >= $total_no_of_pages) ? 'disabled' : ''; ?> " <?= ($page_no < $total_no_of_pages) ? 'href=?page_no=' .$next_page : ''; ?>>Next</a>
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

