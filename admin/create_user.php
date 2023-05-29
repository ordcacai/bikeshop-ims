<?php

include('header.php');

if(!isset($_SESSION['logged_in'])){

    header('location: ../login.php');
    exit;

}else if($_SESSION['user_type'] == 'employee'){

    http_response_code(404);
    include('my_404.php'); // provide your own HTML for the error page
    die();

}else if($_SESSION['user_type'] == 'user'){

    http_response_code(404);
    include('my_404.php'); // provide your own HTML for the error page
    die();

}else{

}

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

        //Check if password don't match
        if($password !== $confirmPassword){

            echo '<script>alert("Password dont match!");</script>';
        
        //Check if password don't have 6 characters
        }else if((strlen($password) < 6)){

            echo '<script>alert("Password must be at least 6 characters!");</script>';

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

                    header('location: create_user.php?error=User with this email already exist!');

                //if there is no user registered in the email, create a new user
                }else{

                    $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password, user_type)
                                            VALUES (?, ?, ?, ?)");
                    $stmt->bind_param('ssss', $name, $email, md5($password), $user_type);
                    $stmt->execute();

                    if(!$stmt->execute()){

                        header('location:account.php?user_created=Account created successfully!');

                    }else{

                        header('location:account.php?user_failed=Account creation failed.');

                    }

                }
        } 
}  

?>
    <?php include('sidemenu.php'); ?>   

<div class="main-content">
<a href="account.php" class="return"><i class="fas fa-chevron-circle-left"></i></a>
    <div class="container-fluid">
            <h2 class="form-weight-bold my-5 text-center">Create Account</h2>

        <div class="mx-auto container">
            <form action="create_user.php" id="register-form" method="POST">
                <p style="color: red;"><?php if(isset($_GET['error'])){echo $_GET['error']; }?></p>

                <div class="form-group my-3">
                    <label><strong>Name</strong></label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group my-3">
                    <label><strong>Email</strong></label>
                    <input type="email" class="form-control" id="register-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group my-3">
                            <label><strong>Role</strong></label>
                            <select class="form-select" required name="user_type">      
                                <option value="admin">Admin</option>
                                <option value="employee">Employee</option>
                            </select>
                        </div>
                <div class="form-group my-3">
                    <label><strong>Password</strong></label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group my-3">
                    <label><strong>Confirm Password</strong></label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm Password" required>
                </div>
                <div class="form-group mt-5">
                    <input type="submit" class="btn btn-primary" id="register-btn" name="register" value="Register">
                </div>
            </form>
        </div>
    </div>
</div>