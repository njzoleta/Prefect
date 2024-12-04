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
  <title>Admin Log</title>

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="assets\css\llog.css">
</head>

<body>

<!-- ======= Header ======= -->
<?php include('C:\xampp\htdocs\Prefect\inc\header.php'); ?>
<!-- End Header -->

<!-- ======= Sidebar ======= -->  
<?php include('C:\xampp\htdocs\Prefect\inc\adminsidebar.php'); ?>
<!-- End Sidebar-->

<main id="main" class="main">
  <div class="pagetitle">
    <h1 class="dashboard">AdminLog</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
        <li class="breadcrumb-item active">AdminLog</li>
        <li class="breadcrumb-item active">Manage</li>
      </ol>
    </nav>
  </div>   

  <div id="content-wrapper">
    <div class="container-fluid">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>Admin Log
        </div>
        <div class="col-12">
          <div class="card recent-sales overflow-auto">
            <div class="card-body">
              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Id Number</th>
                    <th>Name</th>


                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $ret = "SELECT * FROM bcp_sms3_admin WHERE AccountId ORDER BY RAND() LIMIT 100";
                    $stmt = $mysqli->prepare($ret);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    $cnt = 1;
                    while ($row = $res->fetch_object()) {
                  ?>
                    <tr>
                      <td><?php echo $cnt++; ?></td>
                      <td><?php echo htmlspecialchars($row->AccountId); ?></td>
                      <td><?php echo htmlspecialchars($row->name); ?></td>

                      <td>
                      <a id="approve" href="admin_delete_user.php?AccoundId=<?php echo $row->AccountId; ?>" class="badge badge-danger"><i class="fa fa-trash"></i>Update </a>
                        <a id="delete" href="admin_delete_user.php?AccoundId=<?php echo $row->AccountId; ?>" class="badge badge-danger"><i class="fa fa-trash"></i> Delete</a>
                      </td>
                    </tr>
                    <?php $cnt = $cnt+1; }?>
                    </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</main>

<?php include('C:\xampp\htdocs\Prefect\inc\footer.php'); ?>



<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
