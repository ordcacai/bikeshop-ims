<?php
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
          <li><a href="invoice.php">Invoice & Payments</a></li>
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
        </ul>
      </li>
    <!--  <li>
        <a href="sales.php">
          <i class='bx bx-money' ></i>
          <span class="link_name">Sales</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="sales.php">Sales</a></li>
        </ul>
      </li> -->
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
          <li><a href="report_stocks.php">Stock Report</a></li>
          <li><a href="report_sales.php">Sales Report</a></li>
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