<?php

    include('layouts/header.php');

?> 
    
<br>
<div class="container text-center mt-5 py-md-5">
    <h3>Frequently Asked Questions</h3><br>
    <hr class="mx-auto">
</div>

<div class="container"> </div> 

<div class="accordion w-75 mx-auto" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
      Where is your shop located?
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>Our shop is located at 59C Gen. Ordonez Ave. Marikina City</strong> We also have other branches. One in Sta. Rosa, Laguna and one in Trece, Cavite.
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
      What mode of payments do you offer?
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>We accept cash payments and we have a lot installment options.</strong> We accept cash payments and also consider payments thru Gcash or Bank transfer. We accept installment plans through 
      Home Credit, Credit Cards, Atome App, BillEase App and Cashalo App.
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
      How do I place an order?
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>You can place your order by messaging us through our Facebook page. Our admin will be happy to serve you!</strong> 
        You can also place an order through our website, just fill up the order form and wait for our confirmation for your order.
      </div>
    </div>
  </div>
</div>

    <?php include('layouts/footer.php'); ?>