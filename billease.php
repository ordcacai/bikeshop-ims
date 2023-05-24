<?php include('mop.php');?>

<section>
    <div id="billease">
      <div id="billease_banner" style=padding-left:150px>  
            <h1>Buy Now, Pay Later with Billease</h1>
            <p>100% online process, loan at your convenince</p>
        </div>
      </div>

        <div id="billease_banner2">
     
      <div class=text-center>
        <br><h3>What are the Requirements?</h3>
      </div>

    <div class="container mt-5">
      <div class="row">
      <div class="col-sm-3">
          <i class="bi bi-file-person fa-2x"></i>
          <h4>Age Requirement</h4>        
          <p>Must be at least 18 years old.</p>
        </div>

        <div class="col-sm-3">
          <i class="bi bi-credit-card fa-2x"></i>
          <h4>Proof of Billing</h4>
          <p>E.g., Meralco Bill, Electric Bill, Credit card bill, Water bill, Postpaid plan bill, etc.</p>
        </div>

        <div class="col-sm-3">
          <i class="bi bi-person-vcard fa-2x"></i>
          <h4>Valid ID</h4>
          <p>Must have at least one valid ID that corresponds your registration details in the app.</p>
          <p><a class="nav-item" data-bs-toggle="modal" data-bs-target="#list_id_atome" style="color:black">List of Valid IDs</a></p> 
             <!-- Modal for List of IDs -->
        <div class="modal fade" id="list_id_atome">
          <div class="modal-dialog">
            <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">List of Valid IDs</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <ul style="list-style-type: none" style="padding-left:1em"> 
            <li><i class="bi bi-check2 fa-lg"></i> Driver's Liscense ID</li>
            <li><i class="bi bi-check2 fa-lg"></i> PRC ID</li>
            <li><i class="bi bi-check2 fa-lg"></i> Passport</li>
            <li><i class="bi bi-check2 fa-lg"></i> Unified Multi-Purpose ID</li>
            <li><i class="bi bi-check2 fa-lg"></i> GSIS E-Card</li>
            <li><i class="bi bi-check2 fa-lg"></i> Senior Citizen ID</li>
            <li><i class="bi bi-check2 fa-lg"></i> Immigration ID</li>
            <li><i class="bi bi-check2 fa-lg"></i> NBI Clearance</li>
            <li><i class="bi bi-check2 fa-lg"></i> TIN ID</li>
          </ul>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
      </div>
    </div>
        </div>

        <div class="col-sm-3">
          <i class="bi bi-phone fa-2x"></i>
          <h4>Proof of Income</h4>        
          <p>E.g, Payslips, Screenshot of Bank transaction history, remittances slips, paypal transaction history, etc.</p>
        </div>
    </div><br>
  

        </div>

</section>

<?php include('layouts/footer.php');?>