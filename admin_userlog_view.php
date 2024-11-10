<?php
session_start();
include('connect.php'); 
include('checklog.php');
check_login();


$query = "SELECT AccountId, name, year, course, section FROM bcp_sms3_user WHERE category = 'User'";
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
  <title>Userlog View</title>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<!-- Header -->
<?php include('C:\xampp\htdocs\Prefect\inc\header.php'); ?>
<!-- End Header -->

<!-- Sidebar -->
<?php include('C:\xampp\htdocs\Prefect\inc\adminsidebar.php'); ?>
<!-- End Sidebar -->

<main id="main" class="main">
  <div class="pagetitle">
    <h1 class="dashboard">User  Log</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
        <li class="breadcrumb-item active">User Log</li>
        <li class="breadcrumb-item active">View</li>
      </ol>
    </nav>
  </div>   

  <!-- User Log Table -->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i> User Log View
    </div>
    <div class="card-body">
     
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Student number</th>
                  <th>Name</th>
                  <th>Year</th>
                  <th>Course</th>
                  <th>Section</th>
                </tr>
              </thead>
              <tbody>
              <?php

              $ret="SELECT * FROM bcp_sms3_user where category = 'User' "; 
              $stmt= $mysqli->prepare($ret) ;
              $stmt->execute() ;
              $res=$stmt->get_result();
              $cnt=1;
              while($row=$res->fetch_object())
              {
              ?>
                    <tr>
                      <td><?php echo $cnt++; ?></td>
                      <td><?php echo $row->AccountId; ?></td>
                      <td><?php echo $row->name; ?></td>
                      <td><?php echo $row->year; ?></td>
                      <td><?php echo $row->course; ?></td>
                      <td><?php echo $row->section; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include('C:\xampp\htdocs\Prefect\inc\footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
