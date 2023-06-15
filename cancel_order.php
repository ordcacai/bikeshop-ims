<?php

    include('layouts/header.php');
    include('server/connection.php');
    

?> 

<?php

    $stmt = $conn->prepare("SELECT order_id FROM orders WHERE user_id = ? AND order_status = 'Pending'");
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    $order_id = $stmt->get_result();

?>

<section>

<!-- Collapsible-->
<br>

<div class="container mb-5">
                <?php if(isset($_GET['request_sent'])){ ?>
                        <div class="alert alert-success alert-dismissible mt-5 pt-4 text-center">
                            <strong><?php echo $_GET['request_sent']; ?></strong> Please check your email and wait a response from our employee.
                            <a href="cancel_order.php" class="close text-success" data-dismiss="alert" aria-label="close" style="float: right; text-decoration: none;"><strong>&times;</strong></a>
                        </div>
                <?php }?>

                <?php if(isset($_GET['request_failed'])){ ?>
                    <div class="alert alert-success alert-dismissible mt-5 text-center">
                            <strong><?php echo $_GET['request_failed']; ?></strong> Please try again.
                            <a href="cancel_order.php" class="close text-success" data-dismiss="alert" aria-label="close" style="float: right; text-decoration: none;"><strong>&times;</strong></a>
                        </div>
                <?php }?>

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
                        <select class="form-control" required name="order_id" id="exampleFormControlSelect1">
                        
                        <?php foreach($order_id as $row){?>
                        <option value="<?php echo $row['order_id']; ?>"><?php echo $row['order_id']; ?></option>
                        <?php }?>

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