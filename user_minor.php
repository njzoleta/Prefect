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
<!-- End Header -->


<!-- ======= Sidebar ======= -->  
<?php include('C:\xampp\htdocs\Prefect\inc\sidebar.php'); ?>
<!-- End Sidebar-->


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>MINOR OFFENCES</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Offences</li>
          <li class="breadcrumb-item active">Minor Offences</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="container">
        <h1 class="mt-4">4.1 MINOR OFFENSES</h1>
        <p>Those offenses not included in the foregoing violations shall be considered minor ones which merit suspension, warning, reprimand, or a disciplinary penalty fixed by the school. However, violation of any of the minor offenses enumerated below for two (2) consecutive times shall be penalized with sanctions as provided under the major offenses.</p>
        
        <ul class="list-group">
            <li class="list-group-item">4.1.1 Not wearing a school ID card</li>
            <li class="list-group-item">4.1.2 Eating inside the classroom, chewing bubble gums</li>
            <li class="list-group-item">4.1.3 Loitering near the gate or any act that may block the flow of human traffic</li>
            <li class="list-group-item">4.1.4 Public Display of Affection</li>
            <li class="list-group-item">4.1.5 Unauthorized posting or use of banners</li>
            <li class="list-group-item">4.1.6 Spitting on the floor or any act that creates unsanitary conditions</li>
            <li class="list-group-item">4.1.7 Improper haircut, dyeing of hair, or wearing inappropriate accessories</li>
            <li class="list-group-item">4.1.8 Entering faculty restrooms without consent</li>
            <li class="list-group-item">4.1.9 Male students entering female comfort rooms or vice versa</li>
            <li class="list-group-item">4.1.10 Unhygienic use of college facilities</li>
            <li class="list-group-item">4.1.11 Bringing in pointed objects</li>
            <li class="list-group-item">4.1.12 Refusal to submit to lawful inspection</li>
            <li class="list-group-item">4.1.13 Using lewd gestures to provoke others</li>
            <li class="list-group-item">4.1.14 Charging cellphones and gadgets inside classrooms and hallways</li>
        </ul>
    </div>
  

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Prefect Department</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
    <a href="">Prefect Department</a>
    </div>
  </footer><!-- End Footer -->






  <!-- Javascript -->
  <script src="assets/js/main.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>