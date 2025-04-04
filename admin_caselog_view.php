<?php
session_start();
include_once('connect.php');
include_once('checklog.php');
check_login(); 

$query = "SELECT * FROM bcp_sms_log";  // Make sure your query is properly defined

$result = mysqli_query($connect, $query); // Use $connect and $query here

if (!$result) {
    die("Query failed: " . mysqli_error($connect));
}

$num_rows = mysqli_num_rows($result);
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
</head>
<body>

<!-- Header -->
<?php include_once('C:\xampp\htdocs\Prefect\inc\header.php'); ?>
<!-- End Header -->

<!-- Sidebar -->
<?php include_once('C:\xampp\htdocs\Prefect\inc\adminsidebar.php'); ?>
<!-- End Sidebar -->

<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="dashboard">Incident Log</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="user.php">Home</a></li>
                <li class="breadcrumb-item active">Incident Log</li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div>

    <!-- Incident Table -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> Incident Log View
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student number</th>
                            <th>Name</th>
                            <th>Year</th>
                            <th>Course</th>
                            <th>Section</th>
                            <th>Severity</th>
                            <th>Penalties</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
    if ($num_rows > 0) {
        $cnt = 1;
        while ($row = mysqli_fetch_object($result)) {
            ?>
            <tr>
                <td><?php echo $cnt++; ?></td>
                <td><?php echo htmlspecialchars($row->Studentnumber_id); ?></td>
                <td><?php echo htmlspecialchars($row->Nameid); ?></td>
                <td><?php echo htmlspecialchars($row->yearid); ?></td>
                <td><?php echo htmlspecialchars($row->courseid); ?></td>
                <td><?php echo htmlspecialchars($row->sectionid); ?></td>
                <td><?php echo htmlspecialchars($row->severityid); ?></td>
                <td><?php echo htmlspecialchars($row->penalties); ?></td>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='9'>No records found.</td></tr>";
    }
    ?>
</tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include_once('C:\xampp\htdocs\Prefect\inc\footer.php'); ?>

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
