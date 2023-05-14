<?php include('header.php'); ?>

<?php
    if(!isset($_SESSION['admin_logged_in'])){
        header('location: login.php');
        exit;
    }
?>
<?php include('sidemenu.php'); ?>

<div class="main-content">
    <div class="container-fluid">
            <h1 class="my-4">Dashboard</h1>
                    <div class="cards">
                        <div class="card-single">
                            <div>
                                <h1>1</h1>
                                <span>Customers</span>
                            </div>
                            <div>
                                <span><i class="fas fa-users"></i></span>
                            </div>
                        </div>
                        <div class="card-single">
                            <div>
                                <h1>2</h1>
                                <span>Orders</span>
                            </div>
                            <div>
                                <span><i class="fas fa-clipboard-list"></i></span>
                            </div>
                        </div>
                        <div class="card-single">
                            <div>
                                <h1>3</h1>
                                <span>Products</span>
                            </div>
                            <div>
                                <span><i class="fas fa-box"></i></span>
                            </div>
                        </div>
                        <div class="card-single">
                            <div>
                                <h1>4</h1>
                                <span>Income</span>
                            </div>
                            <div>
                                <span><i class="fas fa-wallet"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="recent-grid">
                        <div class="orders">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Recent Orders</h3>

                                    <button onclick="window.location.href='orders.php';">View All <span><i class="fas fa-eye"></i></span></button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" width="100%">
                                            <thead>
                                                <tr>
                                                    <td><strong>Order ID</strong></td>
                                                    <td><strong>Customer Name</strong></td>
                                                    <td><strong>Order Status</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Charles</td>
                                                    <td>Pending</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Charles</td>
                                                    <td>Pending</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Charles</td>
                                                    <td>Pending</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Charles</td>
                                                    <td>Pending</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="products">
                            <div class="card">
                                    <div class="card-header">
                                        <h3>Products</h3>

                                        <button onclick="window.location.href='inventory.php';">View All <span><i class="fas fa-eye"></i></span></button>
                                    </div>
                                    <div class="card-body">
                                        <div class="product">
                                            <div class="info">
                                                <img src="../assets/imgs/banner.png" width="40px" height="40px" alt="">
                                                <div>
                                                    <h4>Mountain Bike</h4>
                                                    <small>100</small>
                                                </div>
                                            </div>
                                            <div class="configure">
                                                <span><i class="fas fa-eye"></i></span>
                                                <span><i class="fas fa-edit"></i></span>
                                                <span><i class="fas fa-trash"></i></span>
                                            </div>
                                        </div>
                                        <div class="product">
                                            <div class="info">
                                                <img src="../assets/imgs/banner.png" width="40px" height="40px" alt="">
                                                <div>
                                                    <h4>Mountain Bike</h4>
                                                    <small>100</small>
                                                </div>
                                            </div>
                                            <div class="configure">
                                                <span><i class="fas fa-eye"></i></span>
                                                <span><i class="fas fa-edit"></i></span>
                                                <span><i class="fas fa-trash"></i></span>
                                            </div>
                                        </div>
                                        <div class="product">
                                            <div class="info">
                                                <img src="../assets/imgs/banner.png" width="40px" height="40px" alt="">
                                                <div>
                                                    <h4>Mountain Bike</h4>
                                                    <small>100</small>
                                                </div>
                                            </div>
                                            <div class="configure">
                                                <span><i class="fas fa-eye"></i></span>
                                                <span><i class="fas fa-edit"></i></span>
                                                <span><i class="fas fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>