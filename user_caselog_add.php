<?php
  session_start();
  include('connect.php');
  include('checklog.php');
  check_login();
  if(isset($_POST['addincident']))
    {
            $Studentnumber_Id=$_POST['Studentnumber_Id'];
            $Nameid=$_POST['Nameid'];
            $yearid = $_POST['yearid'];
            $couseid=$_POST['courseid'];
            $sectionid=$_POST['sectionid'];
            $severityid=$_POST['severityid'];
            $offencesid=$_POST['offencesid'];
            $evidence=$_POST['evidence'];
            $involve=$_POST['involve'];
            $query="INSERT INTO `bcp_sms_log`(`Studentnumber_Id`, `Nameid`, `yearid`, `courseid`, `sectionid`, `severityid`, `offencesid`, `evidence`, `involve`,) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]')";
            $stmt = $mysqli->prepare($query);
            $rc=$stmt->bind_param('ssssssssss', $Studentnumber_Id, $Nameid, $yearid, $couseid , $sectionid, $severityid , $offencesid , $evidence , $involve);
            $stmt->execute();
                if($stmt)
                {
                    $succ = "Student incident Added";
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
    <title>Incident Log</title>
  
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
  <?php include('C:\xampp\htdocs\Prefect\inc\sidebar.php'); ?>
  <!-- End Sidebar-->
  <main id="main" class="main">
  <div class="pagetitle">
    <h1 class="dashboard">Incident Log</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
        <li class="breadcrumb-item active">Incident Log</li>
        <li class="breadcrumb-item active">Add</li>
      </ol>
    </nav>
  </div>   

  <div id="content-wrapper">
    <div class="container-fluid">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>Incident Add
        </div>
  <div class="card-body">
    <!-- Add User Form -->
    <form method="POST" id="form"> 
      <div class="form-group">
          <label for="Studentnumber_Id">Student Number</label>
          <input type="text" required class="form-control" id="Studentnumber_Id" name="Studentnumber_Id">
      </div>
      <div class="form-group">
          <label for="NameId">Full Name</label>
          <input type="text" class="form-control" id="NameId" name="NameId">
      </div>
      <div class="form-group">
          <label for="yearId">Year</label>
          <input type="text" class="form-control" id="yearId" name="yearId">
      </div>
      <div class="form-group">
          <label for="courseId">Course</label>
          <input type="text" class="form-control" id="courseId" name="courseId">
      </div>
      <div class="form-group">
          <label for="sectionId">Section</label>
          <input type="text" class="form-control" id="sectionId" name="SectionId">
      </div>
      <div class="form-group">
          <label for="severityId">Severity</label>
          <input type="text" class="form-control" id="severityId" name="severityId">
      </div>
      <div class="form-group">
          <label for="offencesId">Offences</label>
          <input type="text" class="form-control" id="offencesId" name="offencesId">
      </div>
      <div class="form-group">
          <label for="evidence">Evidence</label>
          <input type="text" class="form-control" id="evidence" name="Evidence">
      </div>
      <div class="form-group">
          <label for="involve">Involve</label>
          <input type="text" class="form-control" id="involve" name="involve">
      </div>
      
      <div class="form-group">
          <label for="involve">Penalties</label>
          <input type="text" class="form-control" id="involve" name="Penalties">
      </div>

      <button type="submit" name="add_user" class="btn btn-success">Add Violation</button>
    </form>
    <!-- End Form -->
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