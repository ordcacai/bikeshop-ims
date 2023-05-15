<?php

    include('layouts/header.php');

?> 

<section>

<!-- Collapsible-->
<br>
<div class="container">
  <div class="container text-center mt-5 py-md-5">
      <h3>Frequently Asked Questions</h3><br>
      <hr class="mx-auto">
  </div>

<button class="accordion">Where is your shop located?</button>
<div class="panel">
  <p>Our shop is located at 59C Gen. Ordonez Ave. Marikina City. We also have other branches. One in Sta. Rosa, Laguna and one in Trece, Cavite.</p>
</div>

<button class="accordion">What mode of payments do you offer?</button>
<div class="panel">
  <p>We accept cash payments and we have a lot installment options. We accept cash payments and also consider payments thru Gcash or Bank transfer. We accept installment plans through 
        Home Credit, Credit Cards, Atome App, BillEase App and Cashalo App.</p>
</div>

<button class="accordion">How do I place an order?</button>
<div class="panel">
  <p>You can place your order by messaging us through our Facebook page. Our admin will be happy to serve you!
          You can also place an order through our website, just fill up the order form and wait for our confirmation for your order.</p>
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