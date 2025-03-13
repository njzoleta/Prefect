<?php
session_start();
include('connect.php'); // Ensure this file establishes a connection to your database
include('checklog.php'); // Ensure this file checks if the user is logged in
check_login();

$Studentnumber_Id = $Nameid = $yearid = $courseid = $sectionid = $severityid = $offencesid = $evidence = $involve = $penalties = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';

    if (isset($_POST['addincident'])) { // Check if the addincident button was clicked
        $Studentnumber_Id = $_POST['Studentnumber_Id'] ?? '';
        $Nameid = $_POST['Nameid'] ?? '';
        $yearid = $_POST['yearid'] ?? '';
        $courseid = $_POST['courseid'] ?? '';
        $sectionid = $_POST['sectionid'] ?? '';
        $severityid = $_POST['severityid'] ?? '';
        $offencesid = $_POST['offencesid'] ?? '';
        $involve = $_POST['involve'] ?? '';
        $penalties = $_POST['Penalties'] ?? '';

        // Determine the category based on yearid
        $category = '';
        if (in_array($yearid, ['Grade 11', 'Grade 12'])) {
            $category = 'Senior High';
        } else {
            $category = 'College';
        }

        // Handle file upload
        $evidence = null; // Initialize evidence variable
        $target_dir = "evidencefile/"; // Relative path for the target directory
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); // Create the full file path

        // Ensure the target directory exists and is writable
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);  // Creates the directory if it doesn't exist
        }

        if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == UPLOAD_ERR_OK) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $evidence = $target_file; // Store the file path for database insertion
            } else {
                $errors[] = "Sorry, there was an error uploading your file. Please check the file path and permissions.";
                error_log("File upload error: " . $_FILES['fileToUpload']['error']); // Logs detailed error
            }
        } else {
            $errors[] = "No file uploaded or there was an upload error.";
        }

        // If there are no errors, proceed to insert into the database
        if (empty($errors)) {
            $stmt = $connect->prepare("INSERT INTO bcp_sms_log (Studentnumber_Id, Nameid, yearid, courseid, sectionid, severityid, offencesid, evidence, involve, penalties, incident_date, category) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
            $stmt->bind_param("sssssssssss", $Studentnumber_Id, $Nameid, $yearid, $courseid, $sectionid, $severityid, $offencesid, $evidence, $involve, $penalties, $category);
            if ($stmt->execute()) {
                echo "<script>alert('Incident logged successfully!');</script>";
            } else {
                error_log("Database error: " . $stmt->error);
                $errors[] = "Error adding case: " . $stmt->error;
            }
            $stmt->close();
        }
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
        <h1 class="dashboard">Incident Log</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                <li class="breadcrumb-item active">Incident Log</li>
                <li class="breadcrumb-item active">Add </li>
            </ol>
        </nav>
    </div>    

    <div class="card-body">
        <!-- Add User Form -->
        <form method="POST" id="form" enctype="multipart/form-data"> 
            <input type="hidden" name="action" value="create">
            <div class="form-group">
                <label for="Studentnumber_Id">Student Number</label>
                <input type="text" required class="form-control" id="Studentnumber_Id" name="Studentnumber_Id" value="<?php echo htmlspecialchars($Studentnumber_Id); ?>">
            </div>
            <div class="form-group">
                <label for="Nameid">Full Name</label>
                <input type="text" class="form-control" id="Nameid" name="Nameid" value="<?php echo htmlspecialchars($Nameid); ?>">
            </div>

            <div class="form-group">
                <label for="edityearid" class="form-label">Year/Grade</label>
                <select class="form-select" id="edityearid" name="yearid">
                    <option value="Grade 11" <?php if ($yearid == 'Grade 11') echo 'selected'; ?>>Grade 11</option>
                    <option value="Grade 12" <?php if ($yearid == 'Grade 12') echo 'selected'; ?>>Grade 12</option>
                    <option value="1styear" <?php if ($yearid == '1styear') echo 'selected'; ?>>1st Year</option>
                    <option value="2ndyear" <?php if ($yearid == '2ndyear') echo 'selected'; ?>>2nd Year</option>
                    <option value="3rdyear" <?php if ($yearid == '3rdyear') echo 'selected'; ?>>3rd Year</option>
                    <option value="4rtyear" <?php if ($yearid == '4rtyear') echo 'selected'; ?>>4th Year</option>
                </select>
            </div>
            <div class="form-group">
                <label for="editcourseid" class="form-label">Course</label>
                <select class="form-select" id="editcourseid" name="courseid">
                    <option value="ICT" <?php if ($courseid == 'ICT') echo 'selected'; ?>>ICT</option>
                    <option value="STEM" <?php if ($courseid == 'STEM') echo 'selected'; ?>>STEM</option>
                    <option value="GAS" <?php if ($courseid == 'GAS') echo 'selected'; ?>>GAS</option>
                    <option value="HE" <?php if ($courseid == 'HE') echo 'selected'; ?>>HE</option>
                    <option value="ABMS" <?php if ($courseid == 'ABMS') echo 'selected'; ?>>ABMS</option>
                    <option value="BSIT" <?php if ($courseid == 'BSIT') echo 'selected'; ?>>BSIT</option>
                    <option value="BSTM" <?php if ($courseid == 'BSTM') echo 'selected'; ?>>BSTM</option>
                    <option value="BSEDUC" <?php if ($courseid == 'BSEDUC') echo 'selected'; ?>>BSEDUC</option>
                            <option value="BSCRIM" <?php if ($courseid == 'BSCRIM') echo 'selected'; ?>>BSCRIM</option>
                            <option value="BSHM" <?php if ($courseid == 'BSHM') echo 'selected'; ?>>BSHM</option>
                            <option value="BSENTREP" <?php if ($courseid == 'BSENTREP') echo 'selected'; ?>>BSENTREP</option>
                            <option value="BSOA" <?php if ($courseid == 'BSOA') echo 'selected'; ?>>BSOA</option>
                            <option value="BSBA" <?php if ($courseid == 'BSBA') echo 'selected'; ?>>BSBA</option>
                            <option value="BSP" <?php if ($courseid == 'BSP') echo 'selected'; ?>>BSP</option>
                            <option value="BEEd,BPEd& BTLed" <?php if ($courseid == 'BEEd,BPEd& BTLed') echo 'selected'; ?>>BEEd, BPEd & BTLed</option>
                            <option value="BSCpE" <?php if ($courseid == 'BSCpE') echo 'selected'; ?>>BSCpE</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sectionid">Section</label>
                <input type="text" class="form-control" id="sectionid" name="sectionid" value="<?php echo htmlspecialchars($sectionid); ?>">
            </div>
            <div class="form-group">
                <label for="editseverityid" class="form-label">Severity</label>
                <select class="form-select" id="editseverityid" name="severityid">
                    <option value="Minor" <?php if ($severityid == 'Minor') echo 'selected'; ?>>Minor</option>
                    <option value="Major" <?php if ($severityid == 'Major') echo 'selected'; ?>>Major</option>
                    <option value="Grave" <?php if ($severityid == 'Grave') echo 'selected'; ?>>Grave</option>
                </select>
            </div>
            <div class="form-group">
                <label for="offencesid">Offences</label>
                <input type="text" class="form-control" id="offencesid" name="offencesid" value="<?php echo htmlspecialchars($offencesid); ?>">
            </div>
            <div class="form-group">
                <label for="fileToUpload">Evidence</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <div class="form-group">
                <label for="involve">Involve</label>
                <input type="text" class="form-control" id="involve" name="involve" value="<?php echo htmlspecialchars($involve); ?>">
            </div>
            <div class="form-group">
                <label for="penalties">Penalties</label>
                <input type="text" class="form-control" id="penalties" name="Penalties" value="<?php echo htmlspecialchars($penalties); ?>">
            </div>
            <button type="submit" name="addincident" class="btn btn-success">Add Violation</button>
        </form>
        <!-- End Form -->

        <!-- Display errors if any -->
        <?php
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>" . htmlspecialchars($error) . "</div>";
            }
        }
        ?>
    </div>
</main>

<?php include('C:\xampp\htdocs\Prefect\inc\footer.php'); ?>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
