<?php

    include('layouts/header.php');

?> 

<section>

<br>
<div class="container">
  <div class="container text-center mt-5 py-md-5">
      <h3>Payment Methods</h3><br>
      <hr class="mx-auto">
  </div>
</div>

<div class="container mt-1">

  <!-- Nav Pills -->
  <ul class="nav nav-pills" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-bs-toggle="pill" href="#cash">Cash | Gcash | Bank Transfer</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="pill" href="#hc">Home Credit</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="pill" href="#billease">BillEase App</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="pill" href="#atome">Atome App</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="pill" href="#cashalo">Cashalo App</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="pill" href="#cc">Credit Cards</a>
    </li>
  </ul>

  <!-- Cash Content -->
  <div class="tab-content">
    <div id="cash" class="container tab-pane active"><br><br>
      <h4>Quick FAQs</h4>
      <ul>
        <li>All of our prices are in cash.</li>
        <li>If you pay through bank transfer or Gcash upon purchase, it is considered as cash (No additional fess from us.)</li>
        <li>We have BDO and BPI Bank Accounts. You can also transfer from another bank via InstaPay.</li>
        <li>This payment method is applicable for walk-in customers, online orders and deliveries cathered by our in-house delivery team.</li>
        <li>We also accept payments through Palawan Express, Mlhuillier and other remittances centers.</li>
      </ul> 
      <br><p>Please take note that bank details will be provided upon confirmation of order.</p> 
    </div>

  <!-- Home Credit Content -->

<div id="hc" class="container tab-pane fade"><br>

    <div class=text-center>
      <h3>How to Qualify for a Loan?</h3>
      <p>Ready to make a purchase? Here's what you'll need</p>
    </div>

  <div class="container mt-5">
    <div class="row">
      <div class="col-sm-4">
        <i class="bi bi-person fa-2x"></i>
        <h4>Filipino Citizen</h4>
        <p>Must be a Filipino citize, age 18-68 years old.</p>
      </div>

      <div class="col-sm-4">
        <i class="bi bi-person-vcard fa-2x"></i>
        <h4>Primary ID</h4>
        <p>Must have at least one primary ID that contains your current address.</p>
        <p><a class="nav-link" data-bs-toggle="modal" data-bs-target="#list_id">List of Valid IDs</a></p>  
      </div>
<!-- The Modal -->
<div class="modal fade" id="list_id">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">List of Valid IDs</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <h4>Primary IDs<h4>
        <ul style="list-style-type: none" style="padding-left:1em"> 
          <li><i class="bi bi-check2 fa-lg"></i></i> Voter's ID</li>
          <li><i class="bi bi-check2 fa-lg"></i></i> Driver's Liscense ID</li>
          <li><i class="bi bi-check2 fa-lg"></i></i> Postal ID (New)</li>
          <li><i class="bi bi-check2 fa-lg"></i></i> Philippine Identification Card</li>
          <li><i class="bi bi-check2 fa-lg"></i></i> Unified Multi-Purpose ID (UMID)</li>
          <li><i class="bi bi-check2 fa-lg"></i></i> Professional Regulation (PRC) ID - secondary ID with address required</li>
        </ul>
      <h4>Secondary IDs</h4>
        <ul style="list-style-type: none" style="padding-left:1em"> 
          <li><i class="bi bi-check2 fa-lg"></i></i> Barangay Certificate</li>
          <li><i class="bi bi-check2 fa-lg"></i></i> NBI Clearance</li>
          <li><i class="bi bi-check2 fa-lg"></i></i> Phone Bill / Electric Bill</li>
        </ul>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
      <div class="col-sm-4">
        <i class="bi bi-cash fa-2x"></i>
        <h4>Source of Income</h4>        
        <p>Must have reliable source of income such as a job, a business, a pension or remittances.</p>
      </div>
    </div>

    <br><h4>Quick FAQs</h4>
      <ul>
        <li>Pre-approval loan applications can be done at home using your smartphone or can be done in-store.</li>
        <li>Transactions for Home Credit approval applications is done in-store ONLY.</li>
        <li>It is recommended to have a pre-approval before visiting our shop for approval.</li>
        <li>Minimum amount of purchase is at Php 5,000.00.</li>
      </ul><br>
  </div>

  </div>

  <!-- BillEase Content-->
    <div id="billease" class="container tab-pane fade"><br>
      <h3>BillEase App</h3>
      <p>Content here</p>
    </div>

  <!-- Atome Content-->
    <div id="atome" class="container tab-pane fade"><br>
      <h3>Atome App</h3>
      <p>Content here</p>
    </div>

  <!-- Cashalo Content-->
    <div id="cashalo" class="container tab-pane fade"><br>
      <h3>Cashalo App</h3>
      <p>Content here</p>
    </div>

  <!-- Credit cards Content-->
    <div id="cc" class="container tab-pane fade"><br>
      <h3>Credit Cards</h3>
      <p>Content here</p>
    </div>

  </div>
</div>

  </section>

<?php include('layouts/footer.php'); ?>