<<<<<<< Updated upstream
<?php
=======
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
            <a href="transfer_stock.php">
                <i class="fas fa-minus"></i>
                <span class="nav-item">Transfer Stock</span>
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
>>>>>>> Stashed changes

if(!isset($_SESSION['logged_in'])){

  header('location: ../login.php');
  exit;

}else{

?>

<?php if($_SESSION['user_type']=='admin'){ ?>
<div class="sidebar close">
    <div class="logo-details">
      <div class="logo_name">Vykes MNL</div>
      <i class='bx bx-menu' id="btn" ></i>
    </div>
    
    <ul class="nav-links">
      <li>
        <a href="index.php">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="index.php">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="orders.php">
            <i class='bx bx-cart' ></i>
            <span class="link_name">Orders</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="orders.php">Orders</a></li>
          <li><a href="orders.php">View Orders</a></li>
          <li><a href="retail.php">Add Order</a></li>
          <li><a href="invoice.php">Order Invoice</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="inventory.php">
            <i class='bx bx-package' ></i>
            <span class="link_name">Inventory</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="inventory.php">Inventory</a></li>
          <li><a href="inventory.php">View Products</a></li>
          <li><a href="add_product.php">Add Product</a></li>
          <li><a href="transfer_stocks.php">Transfer Stocks</a></li>
        </ul>
      </li>
      <li>
        <a href="sales.php">
          <i class='bx bx-money' ></i>
          <span class="link_name">Sales</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="sales.php">Sales</a></li>
        </ul>
      </li>
      <li>
        <a href="account.php">
          <i class='bx bxs-user-account' ></i>
          <span class="link_name">Account</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="account.php">Account</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bxs-report' ></i>
            <span class="link_name">Reports</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Reports</a></li>
          <li><a href="#">Stock Report</a></li>
          <li><a href="#">Sales Report</a></li>
        </ul>
      </li>
      <li>
      <?php if(isset($_SESSION['logged_in'])) { ?>
            <a href="logout.php?logout=1">
            <i class='bx bx-log-out' ></i>
            <span class="link_name">Log Out</span>
              </a>
              <ul class="sub-menu blank">
                <li><a class="link_name" href="logout.php?logout=1">Log Out</a></li>
              </ul>
            <?php } ?>
      </li>
</ul>
  </div>
<?php }else if($_SESSION['user_type']=='employee'){ ?>

  <div class="sidebar close">
    <div class="logo-details">
      <div class="logo_name">Vykes MNL</div>
      <i class='bx bx-menu' id="btn" ></i>
    </div>
    
    <ul class="nav-links">
      <li>
        <a href="index.php">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="index.php">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="orders.php">
            <i class='bx bx-cart' ></i>
            <span class="link_name">Orders</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="orders.php">Orders</a></li>
          <li><a href="orders.php">View Orders</a></li>
          <li><a href="retail.php">Add Order</a></li>
          <li><a href="invoice.php">Order Invoice</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="inventory.php">
            <i class='bx bx-package' ></i>
            <span class="link_name">Inventory</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="inventory.php">Inventory</a></li>
          <li><a href="inventory.php">View Products</a></li>
          <li><a href="add_product.php">Add Product</a></li>
          <li><a href="transfer_stocks.php">Transfer Stocks</a></li>
        </ul>
      </li>
      <li>
      <?php if(isset($_SESSION['logged_in'])) { ?>
            <a href="logout.php?logout=1">
            <i class='bx bx-log-out' ></i>
            <span class="link_name">Log Out</span>
              </a>
              <ul class="sub-menu blank">
                <li><a class="link_name" href="logout.php?logout=1">Log Out</a></li>
              </ul>
            <?php } ?>
      </li>
</ul>
  </div>

<?php } ?>
<?php } ?>
 
  <script>
    let btn = document.querySelector('#btn')

     btn.onclick = function() {
        sidebar.classList.toggle('active');
     };

  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });
  </script>
</body>
</html>