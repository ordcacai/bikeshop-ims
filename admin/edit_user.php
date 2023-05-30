<?php include('header.php'); ?>

<?php

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

    if(isset($_GET['user_id'])){

        $user_id = $_GET['user_id'];
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_id=?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $users = $stmt->get_result();//array
        
    }else if(isset($_POST['edit_user'])){

        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $user_id = $_POST['user_id'];

            //Check if password don't match
            if($password !== $confirmPassword){

                header('location: account.php?error=Password dont match!');
            
            //Check if password don't have 6 characters
            }else if((strlen($password) < 6)){

                header('location: account.php?error=Password must be at least 6 Characters!');

            //if password matched    
            }else{

                $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_id = ?");
                $stmt->bind_param('si', md5($password), $user_id);
                $stmt->execute();

                if($stmt->execute()){

                    header('location: account.php?user_updated=Account has been updated successfully!');

                }else{

                    header('location: account.php?user_update_failed=Account update unsuccessful.');
                            
                }

            }

    }

}

?>

<?php include('sidemenu.php'); ?>

<div class="main-content">
<a href="account.php" class="return"><i class="fas fa-chevron-circle-left"></i></a>
    <div class="container-fluid">
            <h2 class="form-weight-bold my-3">Edit Account</h2>
            <div class="table-responsive">

                <div class="mx-auto container">

                    <form id="edit-form" method="POST" action="edit_user.php">

                        <?php foreach($users as $user){ ?>

                        <input type="hidden" value="<?php echo $user['user_id']; ?>" name="user_id">
                        <div class="form-group my-3">
                            <label><strong>ID</strong></label>
                            <p class="my-4"><?php echo $user['user_id']; ?></p>
                        </div>
                        
                        <div class="form-group my-3">
                            <label><strong>Name</strong></label>
                            <p class="my-4"><?php echo $user['user_name']; ?></p>
                        </div>
                        
                        <div class="form-group my-3">
                            <label><strong>Email</strong></label>
                            <p class="my-4"><?php echo $user['user_email']; ?></p>
                        </div>

                        <div class="form-group my-3">
                            <label><strong>Role</strong></label>
                            <p class="my-4"><?php echo $user['user_type']; ?></p>
                        </div>

                        <div class="form-group my-3">

                            <label><strong>Password</strong></label>
                            <input type="password" class="form-control" id="account-password" name="password" value="<?php echo $user['user_password']; ?>" placeholder="Password">

                        </div>

                        <div class="form-group my-3">

                            <label><strong>Confirm Password</strong></label>
                            <input type="password" class="form-control" id="account-confirm-password" name="confirmPassword" value="<?php echo $user['user_password']; ?>" placeholder="Confirm Password">

                        </div>
                        
                        <div class="form-group my-5">
                            <input type="submit" class="btn btn-primary me-5" name="edit_user" value="Save">
                            <input type="reset" class="btn btn-danger" value="Clear">
                        </div>
                        <?php } ?>

                    </form>

                </div>

            </div>

        </main>
    </div>
</div>

