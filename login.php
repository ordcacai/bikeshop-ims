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

    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users
                            WHERE user_email=? AND user_password=? LIMIT 1");

    $stmt->bind_param('ss', $email, $password);

    if($stmt->execute()){

        $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
        $stmt->store_result();

        //Login Successful
        if($stmt->num_rows() == 1){

            $stmt->fetch();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;

            header('location: account.php?login_success= Logged in Successfully!');
        
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
    
    <!-- Login -->

    <section class="my-t py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold mt-5 my-3">Login</h2>
        </div>

        <div class="mx-auto container">
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