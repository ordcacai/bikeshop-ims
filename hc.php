<?php include('mop.php');?>
 

 <!-- Home Credit Content -->

 <div>
    
    <br><br><div class=text-center>
      <h3>How to Qualify for a Loan?</h3>
      <p>Ready to make a purchase? Here's what you'll need</p>
    </div>

  <div class="container mt-5">
    <div class="row">
      <div class="col-sm-4">
        <i class="bi bi-person fa-2x"></i>
        <h4>Filipino Citizen</h4>
        <p>Must be a Filipino citizen, age 18-68 years old.</p>
      </div>

      <div class="col-sm-4">
        <i class="bi bi-person-vcard fa-2x"></i>
        <h4>Primary ID</h4>
        <p>Must have at least one primary ID that contains your current address.</p>
        <p><a class="nav-item" style="text-decoration:none;" data-bs-toggle="modal" data-bs-target="#list_id">List of Valid IDs</a></p>  
      </div>

<!-- Modal for List of IDs -->
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
      <h4>Primary IDs</h4>
      <ul style="list-style-type: none" style="padding-left:1em"> 
          <li><i class="bi bi-check2 fa-lg"></i> Voter's </li>
          <li><i class="bi bi-check2 fa-lg"></i> Driver's Liscense ID</li>
          <li><i class="bi bi-check2 fa-lg"></i> Postal ID (New)</li>
          <li><i class="bi bi-check2 fa-lg"></i> Philippine Identification Card</li>
          <li><i class="bi bi-check2 fa-lg"></i> Unified Multi-Purpose ID</li>
          <li><i class="bi bi-check2 fa-lg"></i> Professional Regulation (PRC) ID - secondary ID with address required</li>
        </ul>
      <h4>Secondary IDs</h4>
        <ul style="list-style-type: none" style="padding-left:1em"> 
          <li><i class="bi bi-check2 fa-lg"></i> Barangay Certificate</li>
          <li><i class="bi bi-check2 fa-lg"></i> NBI Clearance</li>
          <li><i class="bi bi-check2 fa-lg"></i> Phone Bill / Electric Bill</li>
        </ul>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn" style="background-color: darkorange; color: white;" data-bs-dismiss="modal">Close</button>
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

    <br>
    <div class=text-center>
      <br><h3>How to Apply?</h3>
      <p>Home Credit made it easier, with few simple steps!</p>
    </div><br>

    <!-- Card Image -->

    <div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
      <div class="card h-100">
        <img src="assets/imgs/logo.jpg" class="card-img-top" alt="step1">
        <div class="card-body">
          <h5 class="card-title">Step 1</h5>
          <p>Download the Home Credit App, log in and tap the "Product Loan" banner to apply for pre-approval.</p>
        </div>
      </div>
   </div>

    <div class="col">
      <div class="card h-100">
        <img src="assets/imgs/logo.jpg" class="card-img-top" alt="step2">
        <div class="card-body">
          <h5 class="card-title">Step 2</h5>
          <p>Go to our store and approach our staff/sales associate for assistance.</p>
          <p><a class="nav-item" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#must_bring">What you must bring</a></p>
            <!-- Modal for List of IDs -->
  <div class="modal fade" id="must_bring">
    <div class="modal-dialog">
      <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">What Must you Bring</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <ul style="list-style-type: none" style="padding-left:1em"> 
          <li><i class="bi bi-check2 fa-lg"></i> Enough cash for down payment</li>
          <li><i class="bi bi-check2 fa-lg"></i> Active and registered mobile number</li>
          <li><i class="bi bi-check2 fa-lg"></i> At least 1 Primary Valid ID</li>
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
      </div>
    </div>

    <div class="col">
      <div class="card h-100">
        <img src="assets/imgs/logo.jpg" class="card-img-top" alt="step3">
        <div class="card-body">
          <h5 class="card-title">Step 3</h5>
          <p>Our staff/sales associate will process your product loan application.</p>
        </div>
      </div>
    </div>
</div>

    <br>
    <h4>Additional FAQs</h4>
      <ul>
        <li>Pre-approval loan applications can be done at home using your smartphone or can be done in-store.</li>
        <li>Transactions for Home Credit approval applications is done in-store ONLY.</li>
        <li>It is recommended to have a pre-approval before visiting our shop for approval.</li>
        <li>Minimum amount of purchase is Php 5,000.00.</li>
      </ul><br>
  </div>

  </div>

<?php include('layouts/footer.php');?>