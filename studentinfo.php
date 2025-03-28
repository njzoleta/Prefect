<?php
  session_start();
  include('connect.php');
  include('checklog.php');
  check_login();

  // Enhanced error handling for database queries
  $senior_query = "SELECT id, student_number, first_name, last_name, year, course, section FROM bcp_sms3_student WHERE category = 'Senior High'";
  $college_query = "SELECT id, student_number, first_name, last_name, year, course, section FROM bcp_sms3_student WHERE category = 'College'";

  $senior_result = mysqli_query($connect, $senior_query);
  $college_result = mysqli_query($connect, $college_query);

  if (!$senior_result) {
      die('Error fetching Senior High data: ' . mysqli_error($connect));
  }

  if (!$college_result) {
      die('Error fetching College data: ' . mysqli_error($connect));
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Student Info</title>

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">



</head>
<body>


<?php include('C:\xampp\htdocs\Prefect\inc\header.php'); ?>


<?php include('C:\xampp\htdocs\Prefect\inc\adminsidebar.php'); ?>

<main id="main" class="main">
<div class="pagetitle">
  <h1 class="dashboard">Student Info</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
      <li class="breadcrumb-item ">Student Information</li>
    </ol>
  </nav>
</div>

<ul class="nav nav-tabs">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#senior">Senior High</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#college">College</a></li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane fade show active" id="senior">
      <table class="table">
        <thead><tr><th>Student Number</th><th>Name</th><th>Year</th><th>Course</th><th>Section</th></tr></thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($senior_result)) { ?>
          <tr>
            <td><?= $row['student_number'] ?></td>
            <td><a href="profile.php?id=<?= $row['id'] ?>"><?= $row['first_name'] . ' ' . $row['last_name'] ?></a></td>
            <td><?= $row['year'] ?></td>
            <td><?= $row['course'] ?></td>
            <td><?= $row['section'] ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <div class="tab-pane fade" id="college">
      <table class="table">
        <thead><tr><th>Student Number</th><th>Name</th><th>Year</th><th>Course</th><th>Section</th></tr></thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($college_result)) { ?>
          <tr>
            <td><?= $row['student_number'] ?></td>
            <td><a href="profile.php?id=<?= $row['id'] ?>"><?= $row['first_name'] . ' ' . $row['last_name'] ?></a></td>
            <td><?= $row['year'] ?></td>
            <td><?= $row['course'] ?></td>
            <td><?= $row['section'] ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
          </div>
        </div>


            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
  <?php include('C:\xampp\htdocs\Prefect\inc\footer.php'); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html> 