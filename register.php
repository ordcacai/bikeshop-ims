<?php

    include('layouts/header.php');

?> 

<?php

include('server/connection.php');

//if user already registered, take user to the account page       
if(isset($_SESSION['logged_in'])){

    header('location: account.php');
    exit;

}

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

        //Check if password don't match
        if($password !== $confirmPassword){

            header('location: register.php?error=Passwords dont match!');
        
        //Check if password don't have 6 characters
        }else if((strlen($password) < 6)){

            header('location: register.php?error=Password must be atleast 6 Characters!');

        //if there is no error
        }else{

            //check if the email has an existing user
            $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
            $stmt1->bind_param('s', $email);
            $stmt1->execute();
            $stmt1->bind_result($num_rows);
            $stmt1->store_result();
            $stmt1->fetch();

                //if there is already a registered user with this email, display error msg
                if($num_rows != 0){

                    header('location: register.php?error=User with this email already exist!');

                //if there is no user registered in the email, create a new user
                }else{

                
                    $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password)
                                            VALUES (?, ?, ?)");
                    $stmt->bind_param('sss', $name, $email, md5($password));

                    //register the account
                    if($stmt->execute()){

                        $user_id = $stmt->insert_id;
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['user_email'] = $email;
                        $_SESSION['user_name'] = $name;
                        $_SESSION['logged_in'] = true;

                        header('location: account.php?register_success=Registered Successfully!');

                    //account registration failed
                    }else{

                        header('location:register.php?error= Account Registration Failed.');

                    }

                }
            } 
}  

?>
    
    <!-- Register -->

    <section class="my-t py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold mt-3 my-3">Register</h2>
        </div>

        <div class="mx-auto container">
            <form action="register.php" id="register-form" method="POST">
                <p style="color: red;"><?php if(isset($_GET['error'])){echo $_GET['error']; }?></p>
                <div class="form-group">
                    <label><strong>Name</strong></label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label><strong>Email</strong></label>
                    <input type="email" class="form-control" id="register-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label><strong>Password</strong></label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label><strong>Confirm Password</strong></label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" name="register" value="Register">
                </div>
                <div class="form-group">
                    <a href="login.php" id="login-url" class="btn">Do you have an Account? Login Here</a>
                </div>
            </form>
        </div>
    </section>

    <?php include('layouts/footer.php'); ?>