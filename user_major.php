<?php
session_start();
  include('connect.php');
  include('checklog.php');
  check_login();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard</title>

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

</head>
<body>

<!-- ======= Header ======= -->
<?php include('C:\xampp\htdocs\Prefect\inc\header.php'); ?>



<!-- ======= Sidebar ======= -->  
<?php include('C:\xampp\htdocs\Prefect\inc\sidebar.php'); ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>MAJOR OFFENCES</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Offences</li>
          <li class="breadcrumb-item active">Major Offences</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="container">
      <h1 class="mt-4">4.1.2 MAJOR OFFENSES</h1>
      <p contenteditable="true" id="intro-text">Those that immediately call for a meeting with the parents. Temporary holding of a student while awaiting for 
          the arrival of his parent or guardian may be imposed without any prior warning.</p>
      
      <ul class="list-group" id="offenses-list">
          <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="offense-text">4.1.2.1 Unauthorized bringing out of chairs, tables, books, and other school facilities/equipment</span>
              <button class="btn btn-sm btn-outline-primary edit-btn">Edit</button>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="offense-text">4.1.2.2 Smoking within the Campus.</span>
              <button class="btn btn-sm btn-outline-primary edit-btn">Edit</button>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="offense-text">4.1.2.3 Excessive public display of affection e.g. kissing, hugging, necking, petting, and the like.</span>
              <button class="btn btn-sm btn-outline-primary edit-btn">Edit</button>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="offense-text">4.1.2.4 Possession, distribution or perusal of pornographic materials.</span>
              <button class="btn btn-sm btn-outline-primary edit-btn">Edit</button>
          </li>
      </ul>

      <button class="btn btn-primary mt-3" id="add-item-btn">Add Offense</button>
  </div>

  

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Prefect Department</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
    <a href="">Prefect Department</a>
    </div>
  </footer>
  <!-- End Footer -->


  <script src="assets/js/main.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>