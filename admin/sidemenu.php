<div class="sidebar">
    <div class="top">
        <div class="logo">
            <span>VykesMNL</span>
        </div>
        <i class="fas fa-bars" id="btn"></i>
    </div>
    <div class="user">
        <img src="../assets/imgs/logo.jpg" alt="" class="user-img">
        <div>
            <p class="bold">SuperAdmin</p>
            <p>Admin</p>
        </div>
    </div>
    <ul>
        <li>
            <a href="index.php">
                <i class="fas fa-th-large"></i>
                <span class="nav-item">Dashboard</span>
            </a>
        </li>

        <li>
            <a href="orders.php">
                <i class="fas fa-shopping-cart"></i>
                <span class="nav-item">Orders</span>
            </a>
        </li>
        <li>
            <a href="retail.php">
                <i class="fas fa-plus"></i>
                <span class="nav-item">AddOrders</span>
            </a>
        </li>
        <li>
            <a href="invoice.php">
                <i class="fas fa-receipt"></i>
                <span class="nav-item">Invoice</span>
            </a>
        </li>
        <li>
            <a href="inventory.php">
                <i class="fas fa-boxes"></i>
                <span class="nav-item">Inventory</span>
            </a>
        <li>
            <a href="add_product.php">
                <i class="fas fa-plus"></i>
                <span class="nav-item">AddProducts</span>
            </a>
        </li>
        <li>
            <a href="sales.php">
                <i class="fas fa-chart-line"></i>
                <span class="nav-item">Sales</span>
            </a>
        </li>
        <li>
            <a href="account.php">
                <i class="fas fa-user"></i>
                <span class="nav-item">Account</span>
            </a>
        </li>
        <li>
            <?php if(isset($_SESSION['admin_logged_in'])) { ?>
            <a href="logout.php?logout=1">
            <i class="fas fa-sign-out-alt"></i>
                <span class="nav-item">Logout</span>
            </a>
            <?php } ?>
        </li>
    </ul>
</div>

</body>
<script>
     let btn = document.querySelector('#btn')
     let sidebar = document.querySelector('.sidebar')

     btn.onclick = function() {
        sidebar.classList.toggle('active');
     };
</script>
</html>

