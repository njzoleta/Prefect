<?php
session_start();
include('connect.php'); 
include('checklog.php');
check_login();


// Use the correct variable name for the database connection
$query = "SELECT AccountId, name ,year, course , section FROM bcp_sms3_user"; 
$result = $connect->query($query); // Change $mysqli to $connect

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $connect->error); // Change $mysqli to $connect
}

// Fetch results and handle them
$accounts = [];
while ($row = $result->fetch_assoc()) {
    $accounts[] = $row; 
}

// Optionally, you can free the result set
$result->free();

// Close the database connection if it's not needed anymore
$connect->close(); // Change $mysqli to $connect
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Userlog</title>
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
    <h1 class="dashboard">User Log</h1>
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
      <i class="fas fa-table"></i> UserLog View
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
          $cnt = 1; // Initialize counter
          foreach ($accounts as $account) { // Use the $accounts array
          ?>
            <tr>
              <td><?php echo $cnt++; ?></td>
              <td><?php echo htmlspecialchars($account['AccountId']); ?></td>
              <td><?php echo htmlspecialchars($account['name']); ?></td>
              <td><?php echo htmlspecialchars($account['year']); ?></td>
              <td><?php echo htmlspecialchars($account['course']); ?></td>
              <td><?php echo htmlspecialchars($account['section']); ?></td>
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
