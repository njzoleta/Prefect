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
$subjects = explode(',', $student['Subject']);
$schedules = explode(',', $student['Schedule']);
$max = max(count($subjects), count($schedules));
// Get the current data first

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


<?php include('../Prefect/inc/header.php'); ?>


<?php include('../Prefect/inc/adminsidebar.php'); ?>

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
                    <li class="list-group-item"><strong>Fathers Name:</strong> <?= $student['father_name'] ?></li>
                    <li class="list-group-item"><strong>Guardian’s Name:</strong> <?= $student['guardian_name'] ?></li>
                    <li class="list-group-item"><strong>Guardian Contact:</strong> <?= $student['guardian_contact'] ?></li>
                    <div class="card mt-3">
<?php
$subjects = explode(',', $student['Subject']);
$schedules = explode(',', $student['Schedule']);
$max = max(count($subjects), count($schedules));




?>

<h5 class="mt-4">Subjects and Schedules</h5>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Subject</th>
      <th>Schedule</th>
    </tr>
  </thead>
  <tbody>
    <?php for ($i = 0; $i < $max; $i++): ?>
      <tr>
        <td><?= htmlspecialchars(trim($subjects[$i] ?? '')) ?></td>
        <td><?= htmlspecialchars(trim($schedules[$i] ?? '')) ?></td>
      </tr>
    <?php endfor; ?>
  </tbody>
</table>

    <div class="card-header">
        <h5>Offense Details</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Severity</th>
                    <th>Offense</th>
                    <th>Evidence</th>
                    <th>Statement</th>
                    <th>Penalties</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
     $severities = explode(',', $student['severity']);
$offences = explode(',', $student['offence']);
$evidences = explode(',', $student['evidence']);
$statements = explode(',', $student['statement']);
$penalties = explode(',', $student['penalties']);
$dates = explode(',', $student['incident_date']);

// Ensure maximum number of rows
$max = max(count($severities), count($offences), count($evidences), count($statements), count($penalties), count($dates));

for ($i = 0; $i < $max; $i++) {
    echo "<tr>";
    echo "<td>" . ($severities[$i] ?? '') . "</td>";
    echo "<td>" . ($offences[$i] ?? '') . "</td>";

    // Handle Evidence
    $evidence = trim($evidences[$i] ?? '');
    if ($evidence) {
        if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $evidence)) {
            echo "<td><img src='uploads/$evidence' alt='Evidence' width='100'></td>";
        } elseif (preg_match('/\.(pdf)$/i', $evidence)) {
            echo "<td><a href='uploads/$evidence' target='_blank'>View PDF</a></td>";
        } elseif (in_array(strtolower($evidence), ['witness', 'cctv'])) {
            echo "<td><span class='badge bg-info'>" . ucfirst($evidence) . "</span></td>";
        } else {
            echo "<td>$evidence</td>";
        }
    } else {
        echo "<td>No Evidence</td>";
    }

    echo "<td>" . ($statements[$i] ?? '') . "</td>";
    echo "<td>" . ($penalties[$i] ?? '') . "</td>";
    echo "<td>" . ($dates[$i] ?? 'N/A') . "</td>";
    echo "</tr>";
}

                ?>
            </tbody>
        </table>
    </div>
</div>

                </ul>
            </div>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
