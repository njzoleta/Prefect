<?php
  session_start();
  include('connect.php');
  include('checklog.php');
  check_login();
  if(isset($_POST['Add admin']))
    {
            $AccountId=$_POST['AccountId'];
            $name=$_POST['name'];
            $query="INSERT INTO `bcp_sms_admin`(`AccountId`, `name`,) VALUES 
            ('[value-1]','[value-2]'";
            $stmt = $mysqli->prepare($query);
            $rc=$stmt->bind_param('ss', $AccountId, $name,);
            $stmt->execute();
                if($stmt)
                {
                    $succ = "Admin Added";
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
    <title>AdminLog</title>
  
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
      <h1 class="dashboard">Admin Log</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item active">Admin Log</li>
          <li class="breadcrumb-item active">Add</li>


        </ol>
      </nav>
    </div>    

  <div class="card-body">
    <!-- Add User Form -->
    <form method="POST" id="form"> 
      <div class="form-group">
          <label for="AccountId">Student Number</label>
          <input type="text" required class="form-control" id="AccountId" name="AccountId">
      </div>
      <div class="form-group">
          <label for="name">Full Name</label>
          <input type="text" class="form-control" id="name" name="name">
      </div>
      <div class="form-group">
          <label for="password">Password</label>
          <input type="Password" class="form-control" id="password" name="password">
      </div>

      <button type="submit" name="add_user" class="btn btn-success">Add admin</button>
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