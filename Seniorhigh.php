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
  <h1 class="dashboard">Senior highschool</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
      <li class="breadcrumb-item ">Student Information</li>
      <li class="breadcrumb-item active">Senior high</li>
    </ol>
  </nav>
</div>

    <section class="section" id="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Senior High information</h5>


              <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
            <table class="table table-borderless datatable">
              <thead>
                <tr>
                  <th>Student number</th>
                  <th>Name</th>
                  <th>Year</th>
                  <th>Course</th>
                  <th>Section</th>

                </tr>
              </thead>
              <tbody>
                  <?php
                    $ret = "SELECT * FROM bcp_sms_log WHERE Status IN ('Incident Approved', 'Incident Pending', 'Incident Ongoing')";
                    $stmt = $connect->prepare($ret);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    $cnt = 1;

                    while($row = $res->fetch_object()) {
                  ?>
                    <tr>
                      <td><?php echo $row->Studentnumber; ?></td>
                      <td><?php echo $row->nameid; ?></td>
                      <td><?php echo $row->yearid; ?></td>
                      <td><?php echo $row->courseid; ?></td>
                      <td><?php echo $row->sectionid; ?></td>
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