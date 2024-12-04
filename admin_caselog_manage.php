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
  <title>Incident Log </title>

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="assets\css\llog.css">
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
      <h1 class="dashboard">Incident Log</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="user.php">Home</a></li>
          <li class="breadcrumb-item active">Incident Log</li>
          <li class="breadcrumb-item active">Manage</li>

        </ol>
      </nav>
    </div>   

    <div id="content-wrapper">

      <div class="container-fluid">
      <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Student Incident Log</div>
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                   <table class="table table-borderless datatable">
                <thead>
                  <tr>
                  <th>#</th>
                  <th>Student number</th>
                  <th>Name</th>
                  <th>Year</th>
                  <th>Course</th>
                  <th>Section</th>
                  <th>Offence</th>
                  <th>Incident Date</th>
                  <th>Status</th>
                  <th>Action</th> 
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
                      <td><?php echo $cnt++; ?></td>
                      <td><?php echo $row->Studentnumber; ?></td>
                      <td><?php echo $row->nameid; ?></td>
                      <td><?php echo $row->yearid; ?></td>
                      <td><?php echo $row->courseid; ?></td>
                      <td><?php echo $row->sectionid; ?></td>
                      <td><?php echo $row->offencesid; ?></td>
                      <td><?php echo $row->dateofincident; ?></td>
                      <td>
                        <?php
                        if ($row->Status == "Pending") {
                          echo '<span class="badge badge-warning">' . $row->Status . '</span>';
                        } else {
                          echo '<span class="badge badge-success">' . $row->Status . '</span>';
                        }
                        {
                          echo '<span class="badge badge-success">' . $row->Status . '</span>';
                        }
                        ?>
                      </td>
                    <td>
                        <a id="approve" href="#?Studentnumber=<?php echo $row->Studentnumber;?>" class="badge badge-success"><i class = "fa fa-check"></i> Approve</a>
                        <a id="delete" href="#?Studentnumber=<?php echo $row->Studentnumber;?>" class="badge badge-danger"><i class ="fa fa-trash"></i> Delete</a>
                        </i>                  
                    </td>
                  </tr>
                  <?php  $cnt = $cnt +1; }?>
                  
                </tbody>
              </table>
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