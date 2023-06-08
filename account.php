<?php

    include('layouts/header.php');

?> 

<?php

include('server/connection.php');

//if user is not logged in, go to login.php
if(!isset($_SESSION['logged_in'])){

    header('location: login.php');
    exit;

}

if(isset($_GET['logout'])){

    if(isset($_SESSION['logged_in'])){

        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_type']);

        header('location: login.php');
        exit;

    }

}

if(isset($_POST['change_password'])){

    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $user_email = $_SESSION['user_email'];

    //Check if password don't match
    if($password !== $confirmPassword){

        header('location: account.php?error=Passwords dont match!');
    
    //Check if password don't have 6 characters
    }else if((strlen($password) < 6)){

        header('location: account.php?error=Password must be atleast 6 Characters!');

    //if password matched    
    }else{

        $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email = ?");
        $stmt->bind_param('ss', md5($password), $user_email);

        if($stmt->execute()){

        header('location: account.php?message=Password has been changed successfully!');

        }else{

            header('location: account.php?error=Password change unssucessful.');
                    
        }

    }

}

//get orders
if(isset($_SESSION['logged_in'])){

    if($_SESSION['user_type']=='user'){
        
    $user_id = $_SESSION['user_id'];
    // $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY order_id DESC");
    // $stmt->bind_param('i', $user_id);
    // $stmt->execute();

     //1. determine page no.
     if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        //if user has already entered page then page number is the one that they selected
        $page_no = $_GET['page_no'];
    }else{
        //if user just entered the page then default page is 1
        $page_no = 1;
    }

    //2. return number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM orders WHERE user_id = ? ORDER BY order_id DESC");
    $stmt1->bind_param('i', $user_id);
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
    $stmt2 = $conn->prepare("SELECT * FROM orders  WHERE user_id = ? ORDER BY order_id DESC LIMIT $offset, $total_records_per_page");
    $stmt2->bind_param('i', $user_id);
    $stmt2->execute();
    $orders = $stmt2->get_result();//array
    
    }else{
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_type']);
        header('location: ../login.php');
        exit;
    }

}

?>  
    
    <!-- Account -->

    <section class="my-5 py-5">
        <div class="row container mx-auto">
            <div class="text-center mt-5 pt-5 col-lg-6 col-md-12 col-sm-12">
            <p class="text-center" style="color:green;"><?php if(isset($_GET['login_success'])){ echo $_GET['login_success']; }?></p>
            <p class="text-center" style="color:green;"><?php if(isset($_GET['register_success'])){ echo $_GET['register_success']; }?></p>
                <h3 class="font-weight-bold">Account Details</h3>
                <hr class="mx-auto">
                <div class="account-info">
                    <p>Name: <span> <?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];} ?></span></p>
                    <p>Email: <span> <?php if(isset($_SESSION['user_email'])){echo $_SESSION['user_email'];} ?></span></p>
                    <p><a href="#orders" id="order-btn">Your Orders</a></p>
                    <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <form action="account.php" method="POST" id="account-form">
                    <p class="text-center" style="color:red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                    <p class="text-center" style="color:green;"><?php if(isset($_GET['message'])){ echo $_GET['message']; }?></p>
                    
                    <h3>Change Password</h3>
                    <hr class="mx-auto mb-5">
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" class="form-control" id="account-confirm-password" name="confirmPassword" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn" id="change-password-btn" name="change_password" value="Change Password">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Orders -->

    <section id="orders" class="orders container my-5 py-5">
        <div class="container mt-2">
            <h2 class="font-weight-bold text-center">Your Orders</h2>
            <hr class="mx-auto">
        </div>

        <table class="mt-5 pt-5">
            <tr>
                <th>Order ID</th>
                <th>Order Cost</th>
                <th>Order Status</th>
                <th>Order Date</th>
                <th>Order Details</th>
            </tr>

            <?php while($row = $orders->fetch_assoc()){ ?>

                <tr>
                    <td>
                        <!-- <div class="product-info">
                            <img src="assets/imgs/featured1.png" alt="">
                            <div>
                                <p class="mt-5"></p>
                            </div>
                        </div> -->
                        <span><?php echo $row['order_id']; ?></span>
                    </td>

                    <td>
                        <span>₱<?php echo $row['order_cost']; ?></span>
                    </td>

                    <td>
                        <span><?php echo $row['order_status']; ?></span>
                    </td>

                    <td>
                        <span><?php echo $row['order_date']; ?></span>
                    </td>

                    <td>
                        <form method="POST" action="order_details.php">
                            <input type="hidden" name="order_status" value="<?php echo $row['order_status']; ?>">
                            <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                            <input type="submit" class="btn order-details-btn" name="order_details_btn" value="Details">
                        </form>
                    </td>

                </tr>
            
            <?php }?>

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
    </section>

    <?php include('layouts/footer.php'); ?>