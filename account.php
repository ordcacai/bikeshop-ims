<<<<<<< Updated upstream
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
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();

    $orders = $stmt->get_result(); //<- Array
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
    </section>

=======
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

    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();

    $orders = $stmt->get_result(); //<- Array

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
    </section>

>>>>>>> Stashed changes
    <?php include('layouts/footer.php'); ?>