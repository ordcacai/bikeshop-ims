<?php

    include('layouts/header.php');

?>   

    <!-- About Us -->

    <section>
        <div class="container text-center mt-5 py-5">
            <h3 class="mt-5">ABOUT US</h3>
            <hr class="mx-auto">
            <p>Vykes MNL was established mid 2020, pre-pandemic. Vykes MNL is one of the most famous bike shops 
                in Marikina that offers good quality products and services. Throughout the years, Vykes MNL have 
                also established other branches, one in Sta. Rosa, Laguna and one in Trece, Cavite. Vykes MNL 
                continues to serve most of it's loyal customers until now. 
            </p><br>

            <h3 class="margin">Our Branches</h3>
</div>


<!-- First Mini Slideshow -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6">
    <div class="slideshow-container">
        <div class="mySlides1">
          <img src="assets/imgs/vmsr4.jpg" style="width:100%">
        </div>

        <div class="mySlides1">
          <img src="assets/imgs/vmsr5.jpg" style="width:100%">
        </div>

        <div class="mySlides1">
          <img src="assets/imgs/vmsr6.jpg" style="width:100%">
        </div>

        <a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>
        <a class="next" onclick="plusSlides(1, 0)">&#10095;</a>
      </div>
    </div>
        <div class=" col-lg-3"><br>
          <p><strong>VYKES MNL MAIN STA ROSA</strong></p>
          <p><br><i class="bi bi-geo-alt fa-lg"></i><a href="https://goo.gl/maps/RrQVjPPtipFwCL8i6" style="text-decoration:none; color: black;"> Rosal St. Brgy Market Area, Sta Rosa, Laguna </a></p>
          <p><i class="bi bi-telephone fa-lg"></i> 0956-666-6666</p>
          <p><i class="bi bi-facebook fa-lg"></i> Vykes MNL Sta Rosa</p>
        </div>
  </div>
</div>

<!-- Second Mini Slideshow -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6">
      <br><br><div class="slideshow-container">
        <div class="mySlides2">
          <img src="assets/imgs/vmtc1.jpg" style="width:100%">
        </div>

        <div class="mySlides2">
          <img src="assets/imgs/vmtc2.jpg" style="width:100%">
        </div>

        <div class="mySlides2">
          <img src="assets/imgs/vmtc4.jpg" style="width:100%">
        </div>

        <a class="prev" onclick="plusSlides(-1, 1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1, 1)">&#10095;</a>
      </div>
    </div>
        <div class="col-lg-3"><br><br>
          <p><strong>VYKES MNL TRECE CAVITE</strong></p>
          <p><br><i class="bi bi-geo-alt fa-lg"></i><a href="https://goo.gl/maps/RrQVjPPtipFwCL8i6" style="text-decoration:none; color: black;"> Purok 2, De Ocampo, Trece Martires, Cavite </a></p>
          <p><i class="bi bi-telephone fa-lg"></i> 0977-777-7777</p>
          <p><i class="bi bi-facebook fa-lg"></i> Vykes MNL Trece Cavite</p>
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