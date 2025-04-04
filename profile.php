<?php
session_start();
include('connect.php');
require_once 'connect.php'; // This imports $conn
include('checklog.php');
check_login();

if (!isset($conn)) {
    die("Database connection failed."); // Ensure connection is established
}

// Check if ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Use a prepared statement for security
    $stmt = $conn->prepare("SELECT * FROM bcp_sms3_student WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if (!$student) {
        echo "No student found!";
        exit;
    }
} else {
    echo "No ID provided!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $student['first_name'] ?>'s Profile</title>

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/offense.css" rel="stylesheet">

</head>
<body>


<?php include('C:\xampp\htdocs\Prefect\inc\header.php'); ?>


<?php include('C:\xampp\htdocs\Prefect\inc\adminsidebar.php'); ?>

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Student Information</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item">Student Profile</li>
          <li class="breadcrumb-item"><?= $student['first_name'] . ' ' . $student['last_name'] ?></li>
        </ol>
      </nav>
    </div>
                <h3><?= $student['first_name'] . ' ' . $student['last_name'] ?></h3>
                <p class="text-muted"><?= $student['student_number'] ?></p>
            </div>
            <div class="card-body">
                <h5>Profile Details</h5>
                <ul class="list-group">
                <li class="list-group-item"><strong>Course:</strong> <?= $student['course'] ?></li>
                    <li class="list-group-item"><strong>Year/Grade:</strong> <?= $student['year'] ?></li>
                    <li class="list-group-item"><strong>Section:</strong> <?= $student['section'] ?></li>
                    <li class="list-group-item"><strong>Age:</strong> <?= $student['age'] ?></li>
                    <li class="list-group-item"><strong>Gender:</strong> <?= $student['gender'] ?></li>
                    <li class="list-group-item"><strong>Birthdate:</strong> <?= $student['birthdate'] ?></li>
                    <li class="list-group-item"><strong>Religion:</strong> <?= $student['religion'] ?></li>
                    <li class="list-group-item"><strong>Place of Birth:</strong> <?= $student['place_birth'] ?></li>
                    <li class="list-group-item"><strong>Address:</strong> <?= $student['current_address'] ?></li>
                    <li class="list-group-item"><strong>Email:</strong> <?= $student['email_address'] ?></li>
                    <li class="list-group-item"><strong>Contact Number:</strong> <?= $student['contact_number'] ?></li>
                    <li class="list-group-item"><strong>Mother’s Name:</strong> <?= $student['mother_name'] ?></li>
                    <li class="list-group-item"><strong>Father’s Name:</strong> <?= $student['father_name'] ?></li>
                    <li class="list-group-item"><strong>Guardian’s Name:</strong> <?= $student['guardian_name'] ?></li>
                    <li class="list-group-item"><strong>Guardian Contact:</strong> <?= $student['guardian_contact'] ?></li>
                    <li class="list-group-item"><strong>Subject:</strong> <?= $student['Subject'] ?></li>
                    <li class="list-group-item"><strong>Schedule:</strong> <?= $student['Schedule'] ?></li>
                    <li class="list-group-item"><strong>Severity:</strong> <?= $student['severity'] ?></li>
                    <li class="list-group-item"><strong>Offence:</strong> <?= $student['offence'] ?></li>
                    <li class="list-group-item"><strong>Evidence:</strong> <?= $student['evidence'] ?></li>
                    <li class="list-group-item"><strong>Statement:</strong> <?= $student['statement'] ?></li>
                    <li class="list-group-item"><strong>Penalties:</strong> <?= $student['penalties'] ?></li>
                </ul>
            </div>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
