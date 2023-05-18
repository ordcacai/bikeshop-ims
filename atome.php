<?php include('mop.php');?>


<!-- Atome Content-->
<br>
<section>
  <section>
      <div class=text-center>
        <br><h3>What are the Requirements?</h3>
      </div>

    <div class="container mt-5">
      <div class="row">
      <div class="col-sm-3">
          <i class="bi bi-file-person fa-2x"></i>
          <h4>Age Requirement</h4>        
          <p>Must be 18-70 years old</p>
        </div>

        <div class="col-sm-3">
          <i class="bi bi-credit-card fa-2x"></i>
          <h4>Debit or Credit Card</h4>
          <p>Must have an active debit or credit card (At least one).</p>
          <p>Visa or Mastercard is accepted.</p>
        </div>

        <div class="col-sm-3">
          <i class="bi bi-person-vcard fa-2x"></i>
          <h4>Valid ID</h4>
          <p>Must have at least one valid ID that corresponds your registration details in the app.</p>
          <p><a class="nav-item" data-bs-toggle="modal" data-bs-target="#list_id_atome">List of Valid IDs</a></p> 
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
            <li><i class="bi bi-check2 fa-lg"></i> Philippine Identification Card</li>
            <li><i class="bi bi-check2 fa-lg"></i> Unified Multi-Purpose ID</li>
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
          <h4>The Atome App</h4>        
          <p>Must have an Atome App on your smartphone.</p>
        </div>
    </div><br>
  </section>

    <div id="atome_banner">
      <div class="container"><br>
        <h1>3 easy payments, 0% interest</h1><br>
        <h4>Always Remember that Atome will give you:</h4><br>
        <ul style="list-style-type: none" style="padding-left:5em">
          <li><i class="bi bi-check2-square fa-lg"></i> Credit Limit for Debit Card: Php 15,000</li>
          <li><i class="bi bi-check2-square fa-lg"></i> Credit Limit for Credit Card: Php 50,000</li>
          <li><i class="bi bi-check2-square fa-lg"></i> 0% Interest for 3 payment terms</li>
        </ul>
      </div>
    </div>

    <div class=text-center>
        <br><h3>How does it work?</h3><br>
    </div>

    <!-- Card Image -->
<div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
      <div class="card h-100">
        <img src="assets/imgs/logo.jpg" class="card-img-top" alt="step1">
        <div class="card-body">
          <h5 class="card-title">Step 1</h5>
          <p>Download the Atome App, register and provide your debit/credit card. Make sure that your account is verified.</p>
        </div>
      </div>
   </div>

    <div class="col">
      <div class="card h-100">
        <img src="assets/imgs/logo.jpg" class="card-img-top" alt="step2">
        <div class="card-body">
          <h5 class="card-title">Step 2</h5>
          <p>Make your payment. Send us your order and we will provide a payment link or scan our QR code at the store if you plan to visit us.</p>
          
          </div>
      </div>
    </div>

    <div class="col">
      <div class="card h-100">
        <img src="assets/imgs/logo.jpg" class="card-img-top" alt="step3">
        <div class="card-body">
          <h5 class="card-title">Step 3</h5>
          <p>Click the "Pay" button and review your bills.</p>
          <p>Please note that your first payment will serve as your down payment.</p>
        </div>
      </div>
    </div>
</div>
</div>
  
</section>

<?php include('layouts/footer.php');?>