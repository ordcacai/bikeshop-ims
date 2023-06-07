<?php

    include('layouts/header.php');
    

?> 

<section>

<!-- Collapsible-->
<br>
<div class="container">
  <div class="container text-center mt-5 py-md-5">
      <h2>Cancel Order Request</h2><br>
      <hr class="mx-auto">
      <form action="cancel_order_email.php" method="POST" class="center-absolute display-grid">

                <div class="form-group checkout-small-element my-4">
                    <label><strong>Name:</strong></label>
                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                </div>

                <div class="form-group checkout-small-element my-4">
                    <label><strong>Email:</strong></label>
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <label><strong>Select Cancel Reason</strong></label>
                    <select class="form-control" required name="subject" id="exampleFormControlSelect1">
                        
                    <option>I want to change my shipping information</option>
                    <option>I changed my mind</option>
                    <option>Change payment method</option>
                    <option>Wrong Product</option>  
                    </select>
                </div>
                <div class="form-group checkout-small-element my-4">
                    <label><strong>Message:</strong></label>
                    <textarea name="message" class="form-control" id="exampleFormControlTextarea1" rows="10" placeholder="Please enter a message and Insert the order ID of the order you want to cancel. No order ID provided means disapproval of order cancel request." required></textarea>
                </div>

                <div class="form-group my-4">
                    <input type="submit" name="cancel_order_btn" class="btn btn-dark" rows="10" required>
                </div>
        

      </form>
  </div>



 
</div>
</section>

    <?php include('layouts/footer.php'); ?>