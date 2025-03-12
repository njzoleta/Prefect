<?php
  session_start();
  include('connect.php');
  include('checklog.php');
  check_login();
  $AccountId = $name = $year = $course = $section = $password = $category = '';
  $errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $action = $_POST['action'] ?? '';

  if ($action == 'create') {
    $AccountId = $_POST['AccountId'] ?? '';
    $name = $_POST['name'] ?? '';
    $year = $_POST['year'] ?? '';
    $course = $_POST['course'] ?? '';
    $section = $_POST['section'] ?? '';
    $password = $_POST['password'] ?? '';
    $category = $_POST['category'] ?? '';  // Added category field

    $stmt = $connect->prepare("INSERT INTO bcp_sms3_user (AccountId, name, year, course, section, password, category) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $AccountId, $name, $year, $course, $section, $password, $category);  // Added category bind
    if ($stmt->execute()) {
        echo "<script>alert('Admin account added successfully!');</script>";
    } else {
        error_log("Database error: " . $stmt->error);
        $errors[] = "Error adding admin account: " . $stmt->error;
    }
    $stmt->close();
}
}

$query = "SELECT AccountId, name, year, course, section, password, category FROM bcp_sms3_user";
$result = mysqli_query($connect, $query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>User Log</title>

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/llog.css">
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
            <h1 class="dashboard">Userlog</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                    <li class="breadcrumb-item active">Userlog</li>
                    <li class="breadcrumb-item active">Add</li>
                </ol>
            </nav>
        </div>

        <div class="card-body">
            <!-- Add User Form -->
            <form method="POST" id="form">
                <input type="hidden" name="action" value="create">
                <div class="form-group">
                    <label for="AccountId">AccountId</label>
                    <input type="text" required class="form-control" id="AccountId" name="AccountId" value="<?php echo htmlspecialchars($AccountId); ?>">
                </div>
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
                </div>
                <div class="form-group">
                    <label for="edityear" class="form-label">Year/Grade</label>
                    <select class="form-select" id="edityear" name="year" value="<?php echo htmlspecialchars($year); ?>">
                        <option value="Grade 11">Grade 11</option>
                        <option value="Grade 12">Grade 12</option>
                        <option value="1styear">1st Year</option>
                        <option value="2ndyear">2nd Year</option>
                        <option value="3rdyear">3rd Year</option>
                        <option value="4thyear">4th Year</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editcourse" class="form-label">Course</label>
                    <select class="form-select" id="editcourseid" name="course" value="<?php echo htmlspecialchars($course); ?>">
                        <option value="ICT">ICT</option>
                        <option value="STEM">STEM</option>
                        <option value="GAS">GAS</option>
                        <option value="HE">HE</option>
                        <option value="ABMS">HUMSS</option>
                        <option value="BSIT">BSIT</option>
                        <option value="BSTM">BSTM</option>
                        <option value="BSEDUC">BSEDUC</option>
                        <option value="BSCRIM">BSCRIM</option>
                        <option value="BSHM">BSHM</option>
                        <option value="BSENTREP">BSENTREP</option>
                        <option value="BSOA">BSOA</option>
                        <option value="BSBA">BSBA</option>
                        <option value="BSP">BSP</option>
                        <option value="BEEd, BPEd & BTLed">BEEd, BPEd & BTLed</option>
                        <option value="BSCpE">BSCpE</option>
                        <option value="BSAIS">BSAIS</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="section">Section</label>
                    <input type="text" class="form-control" id="section" name="section" value="<?php echo htmlspecialchars($section); ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
                </div>
                <div class="form-group">
                    <label for="editcourse" class="form-label">category</label>
                    <select class="form-select" id="editcategory" name="category" value="<?php echo htmlspecialchars($category); ?>">
                        <option value="User">User</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Add User</button>
            </form>
            <!-- End Form -->
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
