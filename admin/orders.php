
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
    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM orders WHERE order_status = 'Pending'");
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
    $stmt2 = $conn->prepare("SELECT * FROM orders WHERE order_status = 'Pending' ORDER BY order_id DESC LIMIT $offset, $total_records_per_page");
    $stmt2->execute();
    $orders = $stmt2->get_result();//array

?>
<?php include('security.php');
include('sidemenu.php'); ?>

<div class="main-content">
    <div class="container-fluid">
            <h1 class="my-4">Orders</h1>

                <?php if(isset($_GET['order_updated'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['order_updated']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['order_update_failed'])){ ?>
                    <p class="text-center" style="color: red;"><?php echo $_GET['order_update_failed']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['delete_success_message'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['delete_success_message']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['delete_failure_message'])){ ?>
                    <p class="text-center" style="color: red;"><?php echo $_GET['delete_failure_message']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['order_created'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['order_created']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['order_failed'])){ ?>
                    <p class="text-center" style="color: red;"><?php echo $_GET['order_failed']; ?></p>   
                <?php }?>
            
                <ul class="nav nav-pills nav-justified my-5">
                    <li class="nav-item"><a href="#pending" class="nav-link active" data-toggle="pill">Pending</a></li>
                    <li class="nav-item"><a href="#shipped" class="nav-link" data-toggle="pill">For Delivery/Ship out</a></li>
                    <li class="nav-item"><a href="#delivered" class="nav-link" data-toggle="pill">Delivered</a></li>
                    <li class="nav-item"><a href="#cancelled" class="nav-link" data-toggle="pill">Cancelled</a></li>
                    <li class="nav-item"><a href="#walkin" class="nav-link" data-toggle="pill">Walk-Ins</a></li>
                </ul>

            <div class="tab-content">

                <div class="tab-pane show fade active justify-content-center px-5" id="pending" >
                        
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-sm text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">User Address</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">Actions</th>
                                
                                </tr>
                            </thead>
                            <tbody>

                            <?php while($row = $orders->fetch_assoc()) { ?>
                                <tr>
                                    <td><a href="<?php echo "view_order.php?order_id=".$row['order_id']; ?>"><?php echo $row['order_id']; ?></a></td>
                                    <td><?php echo $row['user_name']; ?></td>
                                    <td><?php echo "+63 ".$row['user_phone']; ?></td>
                                    <td><?php echo $row['user_address']; ?></td>
                                    <td><?php echo $row['order_date']; ?></td>
                                    <td><?php echo $row['order_status']; ?></td>
                                    <?php if($row['order_status'] == 'Delivered' || $row['order_status'] == 'Cancelled'){?>
                                    
                                    <td><a class="btn btn-danger" href="delete_order.php?order_id=<?php echo $row['order_id']; ?>" 
                                    onclick="return confirm('Are you sure you want to delete this order? All records under this order will be deleted PERMANENTLY.');">Delete</a></td>
                                    <?php }else{?>
                                    <td>
                                        <a class="btn btn-primary" href="edit_order.php?order_id=<?php echo $row['order_id']; ?>">Update</a>
                                        <a class="btn btn-danger" href="delete_order.php?order_id=<?php echo $row['order_id']; ?>"
                                        onclick="return confirm('Are you sure you want to delete this order? All records under this order will be deleted PERMANENTLY.');">Delete</a>
                                    </td>
                                    
                                    <?php }?>
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

                <?php

                    //1. determine page no.
                    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
                        //if user has already entered page then page number is the one that they selected
                        $page_no_shipped = $_GET['page_no'];
                    }else{
                        //if user just entered the page then default page is 1
                        $page_no_shipped = 1;
                    }

                    //2. return number of products
                    $stmt_shipped = $conn->prepare("SELECT COUNT(*) As total_records FROM orders WHERE order_status = 'Shipped'");
                    $stmt_shipped->execute();
                    $stmt_shipped->bind_result($total_records_shipped);
                    $stmt_shipped->store_result();
                    $stmt_shipped->fetch();

                    //3. products per page
                    $total_records_per_page_shipped = 5;
                    $offset_shipped = ($page_no_shipped-1) * $total_records_per_page_shipped;
                    $previous_page_shipped = $page_no_shipped - 1;
                    $next_page_shipped = $page_no_shipped + 1;
                    $adjacents_shipped = "2";
                    $total_no_of_pages_shipped = ceil($total_records_shipped/$total_records_per_page_shipped);

                    //4. get all products
                    $stmt_shipped_1 = $conn->prepare("SELECT * FROM orders WHERE order_status = 'Shipped' ORDER BY order_id DESC LIMIT $offset_shipped, $total_records_per_page_shipped");
                    $stmt_shipped_1->execute();
                    $orders_shipped = $stmt_shipped_1->get_result();//array

                ?>

                <div class="tab-pane fade active justify-content-center px-5" id="shipped" >

                <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-sm text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">User Address</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">Actions</th>
                                
                                </tr>
                            </thead>
                            <tbody>

                            <?php while($row = $orders_shipped->fetch_assoc()) { ?>
                                <tr>
                                    <td><a href="<?php echo "view_order.php?order_id=".$row['order_id']; ?>"><?php echo $row['order_id']; ?></a></td>
                                    <td><?php echo $row['user_name']; ?></td>
                                    <td><?php echo "+63 ".$row['user_phone']; ?></td>
                                    <td><?php echo $row['user_address']; ?></td>
                                    <td><?php echo $row['order_date']; ?></td>
                                    <td><?php echo $row['order_status']; ?></td>
                                    <?php if($row['order_status'] == 'Delivered' || $row['order_status'] == 'Cancelled'){?>
                                    
                                    <td><a class="btn btn-danger" href="delete_order.php?order_id=<?php echo $row['order_id']; ?>" 
                                    onclick="return confirm('Are you sure you want to delete this order? All records under this order will be deleted PERMANENTLY.');">Delete</a></td>
                                    <?php }else{?>
                                    <td>
                                        <a class="btn btn-primary" href="edit_order.php?order_id=<?php echo $row['order_id']; ?>">Update</a>
                                        <a class="btn btn-danger" href="delete_order.php?order_id=<?php echo $row['order_id']; ?>"
                                        onclick="return confirm('Are you sure you want to delete this order? All records under this order will be deleted PERMANENTLY.');">Delete</a>
                                    </td>
                                    
                                    <?php }?>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                            <nav aria-label="Page navigation example" class="text-center">
                            <ul class="pagination mt-5 justify-content-center">
                                <li class="page-item">
                                    <a class="page-link <?= ($page_no_shipped <= 1) ? 'disabled' : ''; ?> " <?= ($page_no_shipped > 1) ? 'href=?page_no=' .$previous_page_shipped : ''; ?>>Previous</a>
                                </li>


                                <li class="page-item"><a href="?page_no=1" class="page-link">1</a></li>
                                <li class="page-item"><a href="?page_no=2" class="page-link">2</a></li>

                                    <?php if($page_no_shipped >= 3) { ?>
                                        <li class="page-item"><a href="#" class="page-link">...</a></li>
                                        <li class="page-item"><a href="?page_no=<?= $page_no_shipped; ?>" class="page-link"><?= $page_no_shipped; ?></a></li>
                                    <?php } ?>

                                <li class="page-item">
                                    <a class="page-link <?= ($page_no_shipped >= $total_no_of_pages_shipped) ? 'disabled' : ''; ?> " <?= ($page_no_shipped < $total_no_of_pages_shipped) ? 'href=?page_no=' .$next_page_shipped : ''; ?>>Next</a>
                                </li>

                            </ul>
                        </nav>

                        <div class="p-10">
                            <strong>Page <?= $page_no_shipped; ?> of <?= $total_no_of_pages_shipped ?></strong>
                        </div>

                    </div>

                </div>

                <?php

                    //1. determine page no.
                    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
                        //if user has already entered page then page number is the one that they selected
                        $page_no_delivered = $_GET['page_no'];
                    }else{
                        //if user just entered the page then default page is 1
                        $page_no_delivered = 1;
                    }

                    //2. return number of products
                    $stmt_delivered = $conn->prepare("SELECT COUNT(*) As total_records FROM orders WHERE order_status = 'Delivered'");
                    $stmt_delivered->execute();
                    $stmt_delivered->bind_result($total_records_delivered);
                    $stmt_delivered->store_result();
                    $stmt_delivered->fetch();

                    //3. products per page
                    $total_records_per_page_delivered = 5;
                    $offset_delivered = ($page_no_delivered-1) * $total_records_per_page_delivered;
                    $previous_page_delivered = $page_no_delivered - 1;
                    $next_page_delivered = $page_no_delivered + 1;
                    $adjacents_delivered = "2";
                    $total_no_of_pages_delivered = ceil($total_records_delivered/$total_records_per_page_delivered);

                    //4. get all products
                    $stmt_delivered_1 = $conn->prepare("SELECT * FROM orders WHERE order_status = 'Delivered' ORDER BY order_id DESC LIMIT $offset_delivered, $total_records_per_page_delivered");
                    $stmt_delivered_1->execute();
                    $orders_delivered = $stmt_delivered_1->get_result();//array

                ?>

                <div class="tab-pane fade active justify-content-center px-5" id="delivered" >

                <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-sm text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">User Address</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">Actions</th>
                                
                                </tr>
                            </thead>
                            <tbody>

                            <?php while($row = $orders_delivered->fetch_assoc()) { ?>
                                <tr>
                                    <td><a href="<?php echo "view_order.php?order_id=".$row['order_id']; ?>"><?php echo $row['order_id']; ?></a></td>
                                    <td><?php echo $row['user_name']; ?></td>
                                    <td><?php echo "+63 ".$row['user_phone']; ?></td>
                                    <td><?php echo $row['user_address']; ?></td>
                                    <td><?php echo $row['order_date']; ?></td>
                                    <td><?php echo $row['order_status']; ?></td>
                                    <?php if($row['order_status'] == 'Delivered' || $row['order_status'] == 'Cancelled'){?>
                                    
                                    <td><a class="btn btn-danger" href="delete_order.php?order_id=<?php echo $row['order_id']; ?>" 
                                    onclick="return confirm('Are you sure you want to delete this order? All records under this order will be deleted PERMANENTLY.');">Delete</a></td>
                                    <?php }else{?>
                                    <td>
                                        <a class="btn btn-primary" href="edit_order.php?order_id=<?php echo $row['order_id']; ?>">Update</a>
                                        <a class="btn btn-danger" href="delete_order.php?order_id=<?php echo $row['order_id']; ?>"
                                        onclick="return confirm('Are you sure you want to delete this order? All records under this order will be deleted PERMANENTLY.');">Delete</a>
                                    </td>
                                    
                                    <?php }?>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                            <nav aria-label="Page navigation example" class="text-center">
                            <ul class="pagination mt-5 justify-content-center">
                                <li class="page-item">
                                    <a class="page-link <?= ($page_no_delivered <= 1) ? 'disabled' : ''; ?> " <?= ($page_no_delivered > 1) ? 'href=?page_no=' .$previous_page_delivered : ''; ?>>Previous</a>
                                </li>


                                <li class="page-item"><a href="?page_no=1" class="page-link">1</a></li>
                                <li class="page-item"><a href="?page_no=2" class="page-link">2</a></li>

                                    <?php if($page_no_delivered >= 3) { ?>
                                        <li class="page-item"><a href="#" class="page-link">...</a></li>
                                        <li class="page-item"><a href="?page_no=<?= $page_no_delivered; ?>" class="page-link"><?= $page_no_delivered; ?></a></li>
                                    <?php } ?>

                                <li class="page-item">
                                    <a class="page-link <?= ($page_no_delivered >= $total_no_of_pages_delivered) ? 'disabled' : ''; ?> " <?= ($page_no_delivered < $total_no_of_pages_delivered) ? 'href=?page_no=' .$next_page_delivered : ''; ?>>Next</a>
                                </li>

                            </ul>
                        </nav>

                        <div class="p-10">
                            <strong>Page <?= $page_no_delivered; ?> of <?= $total_no_of_pages_delivered ?></strong>
                        </div>

                    </div>

                </div>

                <?php

                    //1. determine page no.
                    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
                        //if user has already entered page then page number is the one that they selected
                        $page_no_cancelled = $_GET['page_no'];
                    }else{
                        //if user just entered the page then default page is 1
                        $page_no_cancelled = 1;
                    }

                    //2. return number of products
                    $stmt_cancelled = $conn->prepare("SELECT COUNT(*) As total_records FROM orders WHERE order_status = 'Cancelled'");
                    $stmt_cancelled->execute();
                    $stmt_cancelled->bind_result($total_records_cancelled);
                    $stmt_cancelled->store_result();
                    $stmt_cancelled->fetch();

                    //3. products per page
                    $total_records_per_page_cancelled = 5;
                    $offset_cancelled = ($page_no_cancelled-1) * $total_records_per_page_cancelled;
                    $previous_page_cancelled = $page_no_cancelled - 1;
                    $next_page_cancelled = $page_no_cancelled + 1;
                    $adjacents_cancelled = "2";
                    $total_no_of_pages_cancelled = ceil($total_records_cancelled/$total_records_per_page_cancelled);

                    //4. get all products
                    $stmt_cancelled_1 = $conn->prepare("SELECT * FROM orders WHERE order_status = 'Cancelled' ORDER BY order_id DESC LIMIT $offset_cancelled, $total_records_per_page_cancelled");
                    $stmt_cancelled_1->execute();
                    $orders_cancelled = $stmt_cancelled_1->get_result();//array

                ?>

                <div class="tab-pane fade active justify-content-center px-5" id="cancelled" >

                <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-sm text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">User Address</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">Actions</th>
                                
                                </tr>
                            </thead>
                            <tbody>

                            <?php while($row = $orders_cancelled->fetch_assoc()) { ?>
                                <tr>
                                    <td><a href="<?php echo "view_order.php?order_id=".$row['order_id']; ?>"><?php echo $row['order_id']; ?></a></td>
                                    <td><?php echo $row['user_name']; ?></td>
                                    <td><?php echo "+63 ".$row['user_phone']; ?></td>
                                    <td><?php echo $row['user_address']; ?></td>
                                    <td><?php echo $row['order_date']; ?></td>
                                    <td><?php echo $row['order_status']; ?></td>
                                    <?php if($row['order_status'] == 'Delivered' || $row['order_status'] == 'Cancelled'){?>
                                    
                                    <td><a class="btn btn-danger" href="delete_order.php?order_id=<?php echo $row['order_id']; ?>" 
                                    onclick="return confirm('Are you sure you want to delete this order? All records under this order will be deleted PERMANENTLY.');">Delete</a></td>
                                    <?php }else{?>
                                    <td>
                                        <a class="btn btn-primary" href="edit_order.php?order_id=<?php echo $row['order_id']; ?>">Update</a>
                                        <a class="btn btn-danger" href="delete_order.php?order_id=<?php echo $row['order_id']; ?>"
                                        onclick="return confirm('Are you sure you want to delete this order? All records under this order will be deleted PERMANENTLY.');">Delete</a>
                                    </td>
                                    
                                    <?php }?>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                            <nav aria-label="Page navigation example" class="text-center">
                            <ul class="pagination mt-5 justify-content-center">
                                <li class="page-item">
                                    <a class="page-link <?= ($page_no_cancelled <= 1) ? 'disabled' : ''; ?> " <?= ($page_no_cancelled > 1) ? 'href=?page_no=' .$previous_page_cancelled : ''; ?>>Previous</a>
                                </li>


                                <li class="page-item"><a href="?page_no=1" class="page-link">1</a></li>
                                <li class="page-item"><a href="?page_no=2" class="page-link">2</a></li>

                                    <?php if($page_no_cancelled >= 3) { ?>
                                        <li class="page-item"><a href="#" class="page-link">...</a></li>
                                        <li class="page-item"><a href="?page_no=<?= $page_no_cancelled; ?>" class="page-link"><?= $page_no_cancelled; ?></a></li>
                                    <?php } ?>

                                <li class="page-item">
                                    <a class="page-link <?= ($page_no_cancelled >= $total_no_of_pages_cancelled) ? 'disabled' : ''; ?> " <?= ($page_no_cancelled < $total_no_of_pages_cancelled) ? 'href=?page_no=' .$next_page_cancelled : ''; ?>>Next</a>
                                </li>

                            </ul>
                        </nav>

                        <div class="p-10">
                            <strong>Page <?= $page_no_cancelled; ?> of <?= $total_no_of_pages_cancelled ?></strong>
                        </div>

                    </div>

                </div>

                <?php

                    //1. determine page no.
                    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
                        //if user has already entered page then page number is the one that they selected
                        $page_no_walkin = $_GET['page_no'];
                    }else{
                        //if user just entered the page then default page is 1
                        $page_no_walkin = 1;
                    }

                    //2. return number of products
                    $stmt_walkin = $conn->prepare("SELECT COUNT(*) As total_records FROM orders WHERE order_status = 'Walk-In'");
                    $stmt_walkin->execute();
                    $stmt_walkin->bind_result($total_records_walkin);
                    $stmt_walkin->store_result();
                    $stmt_walkin->fetch();

                    //3. products per page
                    $total_records_per_page_walkin = 5;
                    $offset_walkin = ($page_no_walkin-1) * $total_records_per_page_walkin;
                    $previous_page_walkin = $page_no_walkin - 1;
                    $next_page_walkin = $page_no_walkin + 1;
                    $adjacents_walkin = "2";
                    $total_no_of_pages_walkin = ceil($total_records_walkin/$total_records_per_page_walkin);

                    //4. get all products
                    $stmt_walkin_1 = $conn->prepare("SELECT * FROM orders WHERE order_status = 'Walk-In' ORDER BY order_id DESC LIMIT $offset_walkin, $total_records_per_page_walkin");
                    $stmt_walkin_1->execute();
                    $orders_walkin = $stmt_walkin_1->get_result();//array

                ?>
                
                <div class="tab-pane fade active justify-content-center px-5" id="walkin" >

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-sm text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">User Address</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">Actions</th>
                                
                                </tr>
                            </thead>
                            <tbody>

                            <?php while($row = $orders_walkin->fetch_assoc()) { ?>
                                <tr>
                                    <td><a href="<?php echo "view_order.php?order_id=".$row['order_id']; ?>"><?php echo $row['order_id']; ?></a></td>
                                    <td><?php echo $row['user_name']; ?></td>
                                    <td><?php echo "+63 ".$row['user_phone']; ?></td>
                                    <td><?php echo $row['user_address']; ?></td>
                                    <td><?php echo $row['order_date']; ?></td>
                                    <td><?php echo $row['order_status']; ?></td>
                                    <?php if($row['order_status'] == 'Delivered' || $row['order_status'] == 'Cancelled'){?>
                                    
                                    <td><a class="btn btn-danger" href="delete_order.php?order_id=<?php echo $row['order_id']; ?>" 
                                    onclick="return confirm('Are you sure you want to delete this order? All records under this order will be deleted PERMANENTLY.');">Delete</a></td>
                                    <?php }else{?>
                                    <td>
                                        <a class="btn btn-primary" href="edit_order.php?order_id=<?php echo $row['order_id']; ?>">Update</a>
                                        <a class="btn btn-danger" href="delete_order.php?order_id=<?php echo $row['order_id']; ?>"
                                        onclick="return confirm('Are you sure you want to delete this order? All records under this order will be deleted PERMANENTLY.');">Delete</a>
                                    </td>
                                    
                                    <?php }?>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                            <nav aria-label="Page navigation example" class="text-center">
                            <ul class="pagination mt-5 justify-content-center">
                                <li class="page-item">
                                    <a class="page-link <?= ($page_no_walkin <= 1) ? 'disabled' : ''; ?> " <?= ($page_no_walkin > 1) ? 'href=?page_no=' .$previous_page_walkin : ''; ?>>Previous</a>
                                </li>


                                <li class="page-item"><a href="?page_no=1" class="page-link">1</a></li>
                                <li class="page-item"><a href="?page_no=2" class="page-link">2</a></li>

                                    <?php if($page_no_walkin >= 3) { ?>
                                        <li class="page-item"><a href="#" class="page-link">...</a></li>
                                        <li class="page-item"><a href="?page_no=<?= $page_no_walkin; ?>" class="page-link"><?= $page_no_walkin; ?></a></li>
                                    <?php } ?>

                                <li class="page-item">
                                    <a class="page-link <?= ($page_no_walkin >= $total_no_of_pages_walkin) ? 'disabled' : ''; ?> " <?= ($page_no_walkin < $total_no_of_pages_walkin) ? 'href=?page_no=' .$next_page_walkin : ''; ?>>Next</a>
                                </li>

                            </ul>
                        </nav>

                        <div class="p-10">
                            <strong>Page <?= $page_no_walkin; ?> of <?= $total_no_of_pages_walkin ?></strong>
                        </div>

                </div>

            </div>
    </div>
</div> 

