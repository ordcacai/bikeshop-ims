<?php

    include('layouts/header.php');

?> 

<?php

include('server/connection.php');

//if user logged in, take user to the account page  
if(isset($_SESSION['logged_in'])){

    header('location: account.php');
    exit;

}

if(isset($_POST['login_btn'])){

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email=? AND user_password=? LIMIT 1");

    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $users = $stmt->get_result();

    while($row = $users->fetch_assoc()){ 
        //Login Successful
        if($row['user_type']=='user'){

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['user_email'] = $row['user_email'];
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['logged_in'] = true;

            header('location: account.php?login_success= Logged in Successfully!');
        

        }else if($row['user_type']=='admin'){

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['user_email'] = $row['user_email'];
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['logged_in'] = true;


            header('location: admin/index.php?login_success= Logged in Successfully!');

        }else if($row['user_type']=='employee'){

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['user_email'] = $row['user_email'];
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['logged_in'] = true;


            header('location: admin/index.php?login_success= Logged in Successfully!');

        //Login error
        }else{

            header('location: login.php?error= Email or Password entered do not match.');

        }
    }
}
?>
    
    <!-- Login -->

    <section class="my-t py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold mt-5 my-3">Login</h2>
        </div>

        <div class="container">
            <form action="login.php" id="login-form" method="POST">
                <p style="color:red;" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error'];} ?></p>
                <div class="form-group">
                    <label><strong>Email</strong></label>
                    <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label><strong>Password</strong></label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login">
                </div>
                <div class="form-group">
                    <a href="register.php" id="register-url" class="btn">Don't have an Account? Register Here</a>
                </div>
            </form>
        </div>
    </section>

    <?php include('layouts/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>
