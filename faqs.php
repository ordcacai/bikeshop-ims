<?php

    include('layouts/header.php');

?> 

<br>
<div class="container text-center mt-5 py-5">
    <h3>Frequently Asked Questions</h3><br>
    <hr class="mx-auto">
</div>
<div class="row mx-auto container"></div>

    <!-- FAQs -->

    <div class="list-group w-100">
        <a href="#shortExampleAnswer1collapse" data-mdb-toggle="collapse" aria-expanded="false"
            aria-controls="shortExampleAnswer1collapse" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">Where is your shop located?</h5>
    </div>

    <p class="mb-1">Our shop is located at 59C Gen. Ordonez Ave. Marikina City</p>
    <small><u>Learn more</u></small>

    <!-- Collapsed content -->

    <div class="collapse mt-3" id="shortExampleAnswer1collapse">
      We also have other branches. One in Sta. Rosa, Laguna and one in Trece, Cavite.
    </div>
</a>
    
  <a href="#shortExampleAnswer2collapse" data-mdb-toggle="collapse" aria-expanded="false"
    aria-controls="shortExampleAnswer1collapse" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">What mode of payments do you offer?</h5>
    </div>
    <p class="mb-1">
      We accept cash payments and we have a lot installment options.
    </p>
    <small class="text-muted"><u>Learn more</u></small>

    <!-- Collapsed content -->
    <div class="collapse mt-3" id="shortExampleAnswer2collapse">
      We accept cash payments and also consider payments thru Gcash or Bank transfer. We accept installment plans through 
      Home Credit, Credit Cards, Atome App, BillEase App and Cashalo App.
    </div>
  </a>
  <a href="#shortExampleAnswer3collapse" data-mdb-toggle="collapse" aria-expanded="false"
    aria-controls="shortExampleAnswer1collapse" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">How do I place an order?</h5>
    </div>
    <p class="mb-1">
      You can place your order by messaging us through our Facebook page. Our admin will be happy to serve you!
    </p>
    <small class="text-muted"><u>Learn more</u></small>

    <!-- Collapsed content -->
    <div class="collapse mt-3" id="shortExampleAnswer3collapse">
      You can also place an order through our website, just fill up the order form and wait for our confirmation for your order.
    </div>
  </a>
</div>

    <?php include('layouts/footer.php'); ?>