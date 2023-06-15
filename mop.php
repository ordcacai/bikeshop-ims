<?php 
include('layouts/header.php');

?>

<br><div class="container text-center mt-5 py-md-5">
      <h3>Payment Methods</h3><br>
      <hr class="mx-auto">
  </div>

<div class="container mt-1">
  <!-- Nav Pills -->
  <ul class="nav nav-pills justify-content-center">
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="cash.php" id="nav-pill-1">Cash | Gcash | Bank Transfer</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="hc.php" id="nav-pill-1">Home Credit</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="billease.php" id="nav-pill-1">BillEase App</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="atome.php" id="nav-pill-1">Atome App</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="cc.php" id="nav-pill-1">Credit Cards</a>
    </li>
  </ul>  
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Get all nav pills
    var navPills = document.querySelectorAll(".nav-item .nav-link");

    // Add click event listener to each nav pill
    navPills.forEach(function(pill) {
      pill.addEventListener("click", function(event) {
        // Remove active class from all nav pills
        navPills.forEach(function(navPills) {
          navPills.classList.remove("active");
        });

        // Add active class to the clicked nav pill
        this.classList.add("active");
      });
    });
  });
</script>