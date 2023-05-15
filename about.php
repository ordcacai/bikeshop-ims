<?php

    include('layouts/header.php');

?>   

    <!-- About Us -->

    <section>
        <div class="container text-center mt-5 py-5">
            <h3 class="mt-5">About Us</h3>
            <hr class="mx-auto">
            <p>Vykes MNL was established mid 2020, pre-pandemic. Vykes MNL is one of the most famous bike shops 
                in Marikina that offers good quality products and services. Throughout the years, Vykes MNL have 
                also established other branches, one in Sta. Rosa, Laguna and one in Trece, Cavite. Vykes MNL 
                continues to serve most of it's loyal customers until now. 
            </p>
        </div>

<!-- First Slideshow -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6">
    <div class="slideshow-container">
        <div class="mySlides1">
          <img src="assets/imgs/vm1.jpg" style="width:100%">
        </div>

        <div class="mySlides1">
          <img src="assets/imgs/vm2.jpg" style="width:100%">
        </div>

        <div class="mySlides1">
          <img src="assets/imgs/vm3.jpg" style="width:100%">
        </div>

        <a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>
        <a class="next" onclick="plusSlides(1, 0)">&#10095;</a>
      </div>
    </div>
        <div class="col-lg-3"><br>
          <p><strong>VYKES MNL MAIN (Marikina)</strong></p>
          <p><br><i class="bi bi-geo-alt fa-lg"></i><a href="https://goo.gl/maps/RrQVjPPtipFwCL8i6"> 59C. Gen. Ordonez Ave., Marikina City </a></p>
          <p><i class="bi bi-telephone fa-lg"></i> 0956-225-6879</p>
          <p><i class="bi bi-facebook fa-lg"></i> Vykes MNL </p>
        </div>
  </div>
</div>

<!-- Second Slideshow -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6">
      <br><br><div class="slideshow-container">
        <div class="mySlides2">
          <img src="assets/imgs/logo.jpg" style="width:100%">
        </div>

        <div class="mySlides2">
          <img src="assets/imgs/vmsr_logo.jpg" style="width:100%">
        </div>

        <div class="mySlides2">
          <img src="assets/imgs/vmtc_logo.jpg" style="width:100%">
        </div>

        <a class="prev" onclick="plusSlides(-1, 1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1, 1)">&#10095;</a>
      </div>
    </div>
        <div class="col-lg-3"><br><br>
          <p><strong>VYKES MNL MAIN (Marikina)</strong></p>
          <p><br><i class="bi bi-geo-alt fa-lg"></i><a href="https://goo.gl/maps/RrQVjPPtipFwCL8i6"> 59C. Gen. Ordonez Ave., Marikina City </a></p>
          <p><i class="bi bi-telephone fa-lg"></i> 0956-225-6879</p>
          <p><i class="bi bi-facebook fa-lg"></i> Vykes MNL </p>
        </div>
  </div>
</div>

<script>
let slideIndex = [1,1];
let slideId = ["mySlides1", "mySlides2"]
showSlides(1, 0);
showSlides(1, 1);

function plusSlides(n, no) {
  showSlides(slideIndex[no] += n, no);
}

function showSlides(n, no) {
  let i;
  let x = document.getElementsByClassName(slideId[no]);
  if (n > x.length) {slideIndex[no] = 1}    
  if (n < 1) {slideIndex[no] = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex[no]-1].style.display = "block";  
}
</script>




    </section>

<?php include('layouts/footer.php'); ?>