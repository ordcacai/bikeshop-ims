<?php include('header.php');?>

<?php

include('../server/connection.php');

//if user logged in, take user to the account page  
if(isset($_SESSION['admin_logged_in'])){

    header('location: index.php');
    exit;

}

if(isset($_POST['login_btn'])){

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins
                            WHERE admin_email=? AND admin_password=? LIMIT 1");

    $stmt->bind_param('ss', $email, $password);

    if($stmt->execute()){

        $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
        $stmt->store_result();

        //Login Successful
        if($stmt->num_rows() == 1){

            $stmt->fetch();

            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_logged_in'] = true;

            header('location: index.php?login_success= Logged in Successfully!');
        
        //Login error
        }else{

            header('location: login.php?error=Email or Password entered do not match.');

        }

    //Login error
    }else{

        header('location: login.php?error= Something went wrong.');

    }
}

?>
    <!-- Admin Login -->

    <h2 class="text-center my-5">Login</h2>
    <div class="mx-auto container">
        <form action="login.php" id="login-form" method="POST" enctype="multipart/form-data">
            <p style="color: red;"><?php if(isset($_GET['error'])){echo $_GET['error']; } ?></p>
            <div class="form-group mt-2">
                <label for="">Email</label>
                <input type="email" class="form-control" id="product-name" name="email" placeholder="Email" required>
            </div>

            <div class="form-group mt-2">
                <label for="">Password</label>
                <input type="password" class="form-control" id="product-desc" name="password" placeholder="Password" required>
            </div>
            
            <div class="form-group mt-5 text-center">
                <input type="submit" class="btn btn-primary" name="login_btn" value="Login">
            </div>
        </form>
    </div>

  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>