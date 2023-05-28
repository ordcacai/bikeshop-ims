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

}

?>
<?php 
 include('sidemenu.php'); ?>

<div class="main-content">
    <div class="container-fluid">
            <h1 class="my-4">Admin Account</h1>
            <div class="container">
                <p>ID: <?php echo $_SESSION['user_id'];?></p>
                <p>Name: <?php echo $_SESSION['user_name'];?></p>
                <p>Email: <?php echo $_SESSION['user_email'];?></p>
            </div>
        </main>
    </div>
</div>
