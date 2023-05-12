<?php include('header.php'); ?>

<?php
    if(!isset($_SESSION['admin_logged_in'])){
        header('location: login.php');
        exit;
    }
?>

        <?php include('sidemenu.php'); ?>

        <div class="main-content">
            <header>
                    <h1 class="my-4">
                        <label for=""><span><i class="fas fa-bars"></i></span></label>
                        Dashboard
                    </h1>

                    <div class="search-wrapper">
                        <span><i class="fas fa-search"></i></span>
                        <input type="search" placeholder="Search here">
                    </div>
                    
                    <div class="user-wrapper">
                        <img src="..assets/imgs/banner.png" width="40px" height="40px" alt="">
                        <div>
                            <h4>Charles</h4>
                            <small>Admin</small>
                        </div>
                    </div>
            </header>

            <main>
                <div class="cards">
                    <div class="card-single">
                        <div>
                            <h1>1</h1>
                            <span>Customers</span>
                        </div>
                        <div>
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <h1>2</h1>
                            <span>Orders</span>
                        </div>
                        <div>
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <h1>3</h1>
                            <span>Products</span>
                        </div>
                        <div>
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <h1>4</h1>
                            <span>Income</span>
                        </div>
                        <div>
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                </div>
            </main>
        </div>
