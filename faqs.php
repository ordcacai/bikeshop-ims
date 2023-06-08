<?php

    include('layouts/header.php');

?> 

<section>

<!-- Collapsible-->
<br>
<div class="container">
  <div class="container text-center mt-5 py-md-5">
      <h3>FREQUENTLY ASKED QUESTIONS</h3><br>
      <hr class="mx-auto">
  </div>

<button class="accordion">Where is your shop located?</button>
<div class="panel my-3">
  <p>Our shop is located at 59C Gen. Ordonez Ave. Marikina City. We also have other branches. One in Sta. Rosa, Laguna and one in Trece, Cavite.</p>
</div>

<button class="accordion">What mode of payments do you offer?</button>
<div class="panel my-3">
  <p>We accept cash payments and we have a lot installment options. We accept cash payments and also consider payments thru Gcash or Bank transfer. We accept installment plans through 
        Home Credit, Credit Cards, Atome App, BillEase App and Cashalo App.</p>
</div>

<button class="accordion">How do I place an order?</button>
<div class="panel my-3">
  <p>You can place your order by messaging us through our Facebook page. Our admin will be happy to serve you!
          You can also place an order through our website, just fill up the order form and wait for our confirmation for your order.</p>
</div>

<button class="accordion">Do you accept split payments?</button>
<div class="panel my-3">
  <p>Yes, we do consider spilt payments. Example, the total amount that you're gonna purchase is 10,000php. You can pay the 5,000php in cash and 5,000php via credit card 
    plus the charge (if there are any). Please note that there are various charges for installment or credit card option.</p>
</div>

<button class="accordion">I want to order a bike. Do you deliver?</button>
<div class="panel my-3">
  <p>Yes, we do! Our delivery team can deliver around Metro Manila. Note that the shipping fee depends on the 
    delivery location.
  </p>
</div>

<button class="accordion">How do I cancel my order?</button>
<div class="panel my-3">
  <h3 class="my-4">Submit an email through order cancel request method.</h3>
  <p>1. Insert your name, email, reason of cancellation and your message in the form.</p>
  <p>2. Insert the Order ID of the order you want to be cancelled.</p>
  <p>3. Click submit and wait for an email response from our employee.</p>
  <p class="ms-5">Do take note, that you can only cancel your order if your order status is pending.</p>
  <p class="ms-5">If you want to request an order cancellation please <a href="cancel_order.php" style="text-decoration:none;">click here.</a></p>
  
</div>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("faq");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>

 
</div>
</section>

    <?php include('layouts/footer.php'); ?>