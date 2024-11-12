<?php
session_start();
  include('connect.php');
  include('checklog.php');
  check_login();
  $AccountId=$_SESSION['AccountId'];

  if(isset($_POST['delete_User']))
    {
            $AccountId = $_GET['AccountId'];
            $AccountId = $_POST['AccountId'];
            $name = $_POST['name'];
            $year  = $_POST['year'];
            $course = $_POST['course'];
            $section  = $_POST['section'];
            $query="update tms_user set AccountId=? ,name=?, year=?, course=?,  section=? where AccountId=?";
            $stmt = $mysqli->prepare($query);
            $rc=$stmt->bind_param('sssssi', $AccountId, $name, $year, $course, $section, $AccountId);
            $stmt->execute();
                if($stmt)
                {
                    $succ = "Booking Deleted";
                }
                else 
                {
                    $err = "Please Try Again Later";
                }
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
      <?php if(isset($succ)) {?>
                        <!--This code for injecting an alert-->
        <script>
                    setTimeout(function () 
                    { 
                        swal("Success!","<?php echo $succ;?>!","success");
                    },
                        100);
        </script>

        <?php } ?>
        <?php if(isset($err)) {?>
        <!--This code for injecting an alert-->
        <script>
                    setTimeout(function () 
                    { 
                        swal("Failed!","<?php echo $err;?>!","Failed");
                    },
                        100);
        </script>

        <?php } ?>

        <h1 class="dashboard">Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="user.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
          <li class="breadcrumb-item active">Dashboard</li>

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
          <!--Add User Form-->
          <?php
            $AccountId=$_GET['AccountId'];
            $ret="select * from bcp_sms3_user where AccountId=?";
            $stmt= $mysqli->prepare($ret) ;
            $stmt->bind_param('i',$aid);
            $stmt->execute() ;//ok
            $res=$stmt->get_result();
            //$cnt=1;
            while($row=$res->fetch_object())
        {
        ?>
          <form method ="POST"> 
            <div class="form-group">
                <label for="exampleInputEmail1">Student Number</label>
                <input type="text" readonly value="<?php echo $row->AccountId;?>" required class="form-control" id="exampleInputEmail1" name="Student Number">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Full Name</label>
                <input type="text" readonly  class="form-control" value="<?php echo $row->name;?>" id="exampleInputEmail1" name="Fullname">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Year</label>
                <input type="text" readonly class="form-control" value="<?php echo $row->year;?>" id="exampleInputEmail1" name="Year">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Course</label>
                <input type="text" readonly class="form-control" value="<?php echo $row->course;?>" id="exampleInputEmail1" name="Course">
            </div>

            <button type="submit" name="delete_booking" class="btn btn-danger">Delete Booking</button>
          </form>
          <!-- End Form-->
        <?php }?>
        </div>
      </div>
       
      <hr>
     

      <!-- Sticky Footer -->
      <?php include("vendor/inc/footer.php");?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" href="admin-logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="vendor/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="vendor/js/demo/datatables-demo.js"></script>
  <script src="vendor/js/demo/chart-area-demo.js"></script>
 <!--INject Sweet alert js-->
 <script src="vendor/js/swal.js"></script>

</body>

</html>
