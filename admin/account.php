<?php include('header.php'); ?>

<?php

if(!isset($_SESSION['logged_in'])){
    header('location: ../login.php');
    exit;
}

?>
<?php include('sidemenu.php'); ?>

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