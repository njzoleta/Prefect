<?php
  session_start();
  include('connect.php');
  include('checklog.php');
  check_login();

  // Fetch data based on category
  $senior_query = "SELECT id, student_number, first_name, last_name, year, course, section FROM bcp_sms3_student WHERE category = 'Senior High'";


  $senior_result = mysqli_query($connect, $senior_query);
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
      <h1>COLLEGE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item ">Student Information</li>
          <li class="breadcrumb-item active">COLLEGE</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">College</h5>



              <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
            <table class="table table-borderless datatable">
            <thead>
                <tr>
                    <th>Student Number</th>
                    <th>Name</th>
                    <th>Year</th>
                    <th>Course</th>
                    <th>Section</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['student_number'] ?></td>
                        <td>
                            <a href="profile.php?id=<?= $row['id'] ?>">
                                <?= $row['first_name'] . ' ' . $row['last_name'] ?>
                            </a>
                        </td>
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
  <?php include('C:\xampp\htdocs\Prefect\inc\footer.php'); ?>->

  <!-- Vendor JS Files -->
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