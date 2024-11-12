<?php
session_start();
  include('connect.php');
  include('checklog.php');
  check_login();
  $query = "SELECT graveId, grave FROM bcp_sms3_grave ";
  $result = $mysqli->query($query);
  if (!$result) {
    die("Query failed: " . $mysqli->error);
  }
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
      <h1>Grave Offences</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Offences</li>
          <li class="breadcrumb-item active">Grave Offences</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="container">
        <h1 class="mt-4">4.1.3 GRAVE OFFENSES</h1>
        <p>These are offenses which are so severe. The proper penalty for which is exclusion or expulsion.</p>
        
        <div class="table-responsive">
       <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
         <thead>
           <tr>
             <th>#</th>
             <th>Rules</th>
           </tr>
         </thead>
         <tbody>
         <?php

         $ret="SELECT * FROM bcp_sms3_grave "; 
         $stmt= $mysqli->prepare($ret) ;
         $stmt->execute() ;
         $res=$stmt->get_result();
         $cnt=1;
         while($row=$res->fetch_object())
         {
         ?>
               <tr>
                 <td><?php echo $cnt++; ?></td>
                 <td><?php echo $row->grave; ?></td>
           <?php } ?>
         </tbody>
       </table>
     </div>
   </div>  
  </main>  
  

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