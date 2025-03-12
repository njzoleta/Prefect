<?php
session_start();
include('connect.php');
include('checklog.php');
check_login();


$AccountId = $name = $password = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action == 'create') {
        $AccountId = $_POST['AccountId'] ?? '';
        $name = $_POST['name'] ?? '';
        $password = $_POST['password'] ?? '';

        $stmt = $connect->prepare("INSERT INTO bcp_sms3_admin (AccountId, name, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $AccountId, $name, $password);
        if ($stmt->execute()) {
            echo "<script>alert('Admin account added successfully!');</script>";
        } else {
            error_log("Database error: " . $stmt->error);
            $errors[] = "Error adding admin account: " . $stmt->error;
        }
        $stmt->close();
    }
}

$query = "SELECT AccountId, name, password FROM bcp_sms3_admin";
$result = mysqli_query($connect, $query);
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
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
    </div>

    <button type="submit" class="btn btn-success">Add Admin</button>
</form>
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