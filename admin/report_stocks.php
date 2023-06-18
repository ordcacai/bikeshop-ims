
<?php include('header.php'); ?>

<?php
    if(!isset($_SESSION['logged_in'])){
        header('location: ../login.php');
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
    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM stocks");
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    //3. products per page
    $total_records_per_page = 5;
    $offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";
    $total_no_of_pages = ceil($total_records/$total_records_per_page);

    //4. get all products
    $stmt2 = $conn->prepare("SELECT * FROM stocks ORDER BY stock_id DESC LIMIT $offset, $total_records_per_page");
    $stmt2->execute();
    $stocks = $stmt2->get_result();//array

?>
<?php include('security.php');
include('sidemenu.php'); ?>

<div class="main-content">
    <div class="container-fluid">

            <h1 class="my-4">Stocks</h1>
            <a class="btn btn-secondary btn mb-5 me-4" style="float:right;" href="print_stocks.php"><i class="fas fa-print"></i> Print</a>
            <a class="btn btn-primary btn mb-5 me-4" style="float:right;" href="stocks_outbound.php"><i class="fas fa-plus-circle"></i> Outbound</a>
            <a class="btn btn-success btn mb-5 me-4" style="float:right;" href="stocks_inbound.php"><i class="fas fa-plus-circle"></i> Inbound</a>
            
                <?php if(isset($_GET['edit_success_message'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['edit_failure_message'])){ ?>
                    <p class="text-center" style="color: red;"><?php echo $_GET['edit_failure_message']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['inbound_created'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['inbound_created']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['outbound_created'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['outbound_created']; ?></p>   
                <?php }?>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-sm text-center">
                        <thead>
                            <tr>
                                <th scope="col">Stock ID</th>
                                <th scope="col">Product ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Color & Size</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php while($row = $stocks->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['stock_id']; ?></a></td>
                                <td><?php echo $row['product_id']; ?></td>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo $row['color_size']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
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

        </div>
    </div>


