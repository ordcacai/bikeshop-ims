<?php include('header.php'); ?>

<?php

if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit;
}

?>
<div class="container-fluid">
    <div class="row" style="min-height:1000px">

        <?php include('sidemenu.php'); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <h1 class="my-4">Admin Account</h1>
            <div class="container">
                <p>ID: <?php echo $_SESSION['admin_id'];?></p>
                <p>Name: <?php echo $_SESSION['admin_name'];?></p>
                <p>Email: <?php echo $_SESSION['admin_email'];?></p>
            </div>
        </main>
    </div>
</div>