<?php
session_start();
  include('connect.php');
  include('checklog.php');
  check_login();
  $AccountId=$_SESSION['AccountId'];

  if(isset($_POST['update_user']))
    {
            $AccountId = $_GET['AccountId'];
            $AccountId = $_POST['AccountId'];
            $name = $_POST['name'];
            $year  = $_POST['year'];
            $course = $_POST['course'];
            $section  = $_POST['section'];
            $query="update bcp_sms3_user set AccountId=? ,name=?, year=?, course=?,  section=? where AccountId=?";
            $stmt = $mysqli->prepare($query);
            $rc=$stmt->bind_param('sssssi', $AccountId, $name, $year, $course, $section, $AccountId);
            $stmt->execute();
                if($stmt)
                {
                    $succ = "User updated";
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
  <title>Userlog</title>

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
<?php include('C:\xampp\htdocs\Prefect\inc\adminsidebar.php'); ?>
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

        <h1 class="dashboard">update</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item active">Userlog</li>
          <li class="breadcrumb-item active">Manage</li>

        </ol>
      </nav>
    </div>   

    <div id="content-wrapper">

      <div class="container-fluid">
      <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            User Log</div>
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">

          <?php

            $ret="select * from bcp_sms3_user where AccountId=?";
            $stmt= $mysqli->prepare($ret) ;
            $stmt->bind_param('i',$AccountId);
            $stmt->execute() ;//ok
            $res=$stmt->get_result();

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

            <button type="submit" name="update_booking" class="btn btn-danger">update Booking</button>
          </form>
          <!-- End Form-->
        <?php }?>
        </div>
      </div>
       
      <hr>
     

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
