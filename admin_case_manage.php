<?php
session_start();
include('connect.php'); 
include('checklog.php');
check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        // Handle delete request
        $Case_id = $_POST['Case_id'];
        $stmt = $connect->prepare("DELETE FROM bcp_sms3_case WHERE Case_id = ?");
        $stmt->bind_param("i", $Case_id);
        if ($stmt->execute()) {
            $_SESSION['message'] = 'Account deleted successfully!';
        } else {
            error_log("Database error: " . $stmt->error);
            $_SESSION['message'] = "Error deleting account.";
        }
        $stmt->close();
    }

    // Handle edit request
    if (isset($_POST['Case_id']) && isset($_POST['Name_accuser'])) {
        $Case_id = $_POST['Case_id'];
        $Name_report = $_POST['Name_report'] ?? '';
        $Section_report = $_POST['Section_report'] ?? '';
        $Course_report = $_POST['Course_report'] ?? '';
        $Year_report = $_POST['Year_report'] ?? '';
        $Adviser_report = $_POST['Adviser_report'] ?? '';
        $Statement = $_POST['Statement'] ?? '';
        $Type_incident = $_POST['Type_incident'] ?? '';
        $Type_Evidence = $_POST['Type_Evidence'] ?? '';
        $Incident_place = $_POST['Incident_place'] ?? '';
        $Time_incident = $_POST['Time_incident'] ?? '';
        $Witness_Name = $_POST['Witness_Name'] ?? NULL;
        $Evidence_File = $_POST['Evidence_File'] ?? NULL;
        $Name_accuser = $_POST['Name_accuser'] ?? '';
        $Section_accuser = $_POST['Section_accuser'] ?? '';
        $Course_accuser = $_POST['Course_accuser'] ?? '';
        $Year_accuser = $_POST['Year_accuser'] ?? '';
        $Adviser_accuser = $_POST['Adviser_accuser'] ?? '';
       
        $stmt = $connect->prepare("UPDATE bcp_sms3_case SET 
        Name_report = ?, 
        Section_report = ?, 
        Course_report = ?, 
        Year_report = ?, 
        Adviser_report = ?,
        Statement = ?, 
        Type_incident = ?, 
        Type_Evidence = ?, 
        Witness_Name = ?,
        Evidence_File = ?,
        Incident_place = ?, 
        Time_incident = ?, 
        Name_accuser = ?, 
        Year_accuser = ?, 
        Course_accuser = ?, 
        Section_accuser = ?, 
        Adviser_accuser = ?
        WHERE Case_id = ?");

$stmt->bind_param("sssssssssssssssssi", 
$Name_report, $Section_report, $Course_report, $Year_report, $Adviser_report,
$Statement, $Type_incident, $Type_Evidence, $Witness_Name, $Evidence_File,$Incident_place, 
$Time_incident, $Name_accuser, $Year_accuser, $Course_accuser, 
$Section_accuser, $Adviser_accuser, $Case_id
);

if ($Witness_Name === NULL || empty($Witness_Name)) {
    $Witness_Name = NULL;
}

if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-warning">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}

        if ($stmt->execute()) {
            $_SESSION['message'] = 'Account updated successfully!';
        } else {
            $_SESSION['message'] = 'Error updating account.';
        }
        $stmt->close();
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_violation'])) {
    $Case_id = $_POST['Case_id'];
    $stmt = $connect->prepare("UPDATE bcp_sms3_case SET status = 'Confirmed' WHERE Case_id = ?");
    $stmt->bind_param("i", $Case_id);

    if ($stmt->execute()) {
        $_SESSION['incident_data'] = [
            'Studentnumber_Id' => $row->Studentnumber_Id, // Assuming you have this in your case
            'Nameid' => $row->Nameid, // Assuming you have this in your case
            'yearid' => $row->Year_accuser, // Assuming you have this in your case
            'courseid' => $row->Course_accuser, // Assuming you have this in your case
            'sectionid' => $row->Section_accuser, // Assuming you have this in your case
            'severityid' => 'Minor', // Set default or based on your logic
            'offencesid' => 'Some Offence', // Set default or based on your logic
            'involve' => 'Involved Person', // Set default or based on your logic
            'penalties' => 'Some Penalty', // Set default or based on your logic
            'statement' => 'Some Statement' // Set default or based on your logic
        ];
        header("Location:admin_caselog_add.php");
        exit(); // Make sure to exit after redirecting
    } else {
        $_SESSION['message'] = "Error updating status.";
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_violation'])) {
    $Case_id = $_POST['Case_id'];
    $stmt = $connect->prepare("UPDATE bcp_sms3_case SET status = 'Confirmed' WHERE Case_id = ?");
    $stmt->bind_param("i", $Case_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Accuser status updated to Confirmed!";
    } else {
        $_SESSION['message'] = "Error updating status.";
    }
}
$query = "SELECT Case_id, 
          COALESCE(Name_report, '') AS Name_report, 
          COALESCE(Section_report, '') AS Section_report, 
          COALESCE(Course_report, '') AS Course_report, 
          COALESCE(Year_report, '') AS Year_report, 
          COALESCE(Adviser_report, '') AS Adviser_report, 
          COALESCE(Statement, '') AS Statement, 
          COALESCE(Type_incident, '') AS Type_incident, 
          COALESCE(Type_Evidence, '') AS Type_Evidence, 
          COALESCE(Incident_place, '') AS Incident_place, 
          COALESCE(Time_incident, '') AS Time_incident, 
          COALESCE(Witness_Name, '') AS Witness_Name, 
          COALESCE(Evidence_File, '') AS Evidence_File, 
          COALESCE(Name_accuser, '') AS Name_accuser, 
          COALESCE(Section_accuser, '') AS Section_accuser, 
          COALESCE(Course_accuser, '') AS Course_accuser, 
          COALESCE(Year_accuser, '') AS Year_accuser, 
          COALESCE(Adviser_accuser, '') AS Adviser_accuser 
          FROM bcp_sms3_case";

$result = $connect->query($query);

if (!$result) {
    die("Query failed: " . $connect->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Case Log</title>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<!-- Header -->
<?php include('/xampp/htdocs/Prefect/inc/header.php'); ?>
<!-- End Header -->
<?php include('/xampp/htdocs/Prefect/inc/adminsidebar.php'); ?>

<main id="main" class="main">
  <div class="pagetitle">
      <h1 class="dashboard">Case Log</h1>
      <nav>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
              <li class="breadcrumb-item active">Case Log</li>
              <li class="breadcrumb-item active">Manage</li>

          </ol>
      </nav>
  </div>   
  <!-- User Log Table -->
  <div class="card mb-3">
      <div class="card-header">
          <i class="fas fa-table"></i> User Log View
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Name of accuser</th>
                          <th>Year</th>
                          <th>Course</th>
                          <th>Section</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody>
    <?php
    if ($result->num_rows > 0) {
        $cnt = 1;
        while ($row = $result->fetch_object()) {
            ?>
            <tr>
                <td><?php echo $cnt++; ?></td>
                <td><?php echo htmlspecialchars($row->Name_accuser); ?></td>
                <td><?php echo htmlspecialchars($row->Year_accuser); ?></td>
                <td><?php echo htmlspecialchars($row->Course_accuser); ?></td>
                <td><?php echo htmlspecialchars($row->Section_accuser); ?></td>
                <td>
    <!-- View Details Button -->
    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewDetailsModal"
    onclick="loadViewDetails('<?php echo $row->Case_id; ?>',
 '<?php echo addslashes($row->Name_report); ?>',
 '<?php echo addslashes($row->Section_report); ?>',
 '<?php echo addslashes($row->Course_report); ?>',
 '<?php echo addslashes($row->Year_report); ?>',
 '<?php echo addslashes($row->Adviser_report); ?>',
 '<?php echo addslashes($row->Statement); ?>',
 '<?php echo addslashes($row->Type_incident); ?>',
 '<?php echo addslashes($row->Type_Evidence); ?>',
 '<?php echo addslashes($row->Incident_place); ?>',
 '<?php echo addslashes($row->Time_incident); ?>',
 '<?php echo addslashes($row->Witness_Name); ?>',
 '<?php echo addslashes($row->Evidence_File); ?>',
 '<?php echo addslashes($row->Name_accuser); ?>',
 '<?php echo addslashes($row->Year_accuser); ?>',
 '<?php echo addslashes($row->Course_accuser); ?>',
 '<?php echo addslashes($row->Section_accuser); ?>',
 '<?php echo addslashes($row->Adviser_accuser); ?>')">View Details</button>

    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
onclick="loadEditData(
    '<?php echo addslashes($row->Case_id); ?>', 
    '<?php echo addslashes($row->Name_report); ?>', 
    '<?php echo addslashes($row->Section_report); ?>', 
    '<?php echo addslashes($row->Course_report); ?>', 
    '<?php echo addslashes($row->Year_report); ?>', 
    '<?php echo addslashes($row->Adviser_report); ?>',
    '<?php echo addslashes($row->Statement); ?>', 
    '<?php echo addslashes($row->Type_incident); ?>', 
    '<?php echo addslashes($row->Type_Evidence); ?>', 
    '<?php echo addslashes($row->Witness_Name); ?>', 
    '<?php echo addslashes($row->Incident_place); ?>', 
    '<?php echo addslashes($row->Time_incident); ?>',
    '<?php echo addslashes($row->Name_accuser); ?>', 
    '<?php echo addslashes($row->Year_accuser); ?>', 
    '<?php echo addslashes($row->Course_accuser); ?>', 
    '<?php echo addslashes($row->Section_accuser); ?>',
    '<?php echo addslashes($row->Adviser_accuser); ?>')">Edit</button>

    <!-- Delete Button -->
    <form method="POST" style="display:inline-block;" onsubmit="return confirmDelete(event, '<?php echo $row->Case_id; ?>');">
        <input type="hidden" name="Case_id" value="<?php echo $row->Case_id; ?>">
        <input type="hidden" name="action" value="delete">
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
    </form>

    <form method="POST" onsubmit="return confirm('Are you sure you want to confirm this violation?');">
    <input type="hidden" name="Case_id" value="<?php echo $row->Case_id; ?>">
    <button type="submit" name="confirm_violation" class="btn btn-warning btn-sm">Confirm Violation</button>
</form>
</td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='7' class='text-center'>No records found</td></tr>";
    }
    ?>
</tbody>
              </table>
          </div>
      </div>
  </div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                    <input type="hidden" name="Case_id" id="editCase_id">

                    <div class="form-group">
                        <label for="editName_report">Name of Reporter:</label>
                        <input type="text" class="form-control" id="editName_report" name="Name_report" required>
                    </div>
                    <div class="form-group">
                        <label for="editSection_report">Section:</label>
                        <input type="text" class="form-control" id="editSection_report" name="Section_report" required>
                    </div>
                    <div class="form-group">
                        <label for="editCourse_report">Course:</label>
                        <input type="text" class="form-control" id="editCourse_report" name="Course_report" required>
                    </div>
                    <div class="form-group">
                        <label for="editYear_report">Year</label>
                        <input type="text" class="form-control" id="editYear_report" name="Year_report" required>
                    </div>
                    <div class="form-group">
                        <label for="editAdviser_report">Adviser</label>
                        <input type="text" class="form-control" id="editAdviser_report" name="Adviser_report" required>
                    </div>


                    <div class="form-group">
                        <label for="editStatement">Statement</label>
                        <textarea class="form-control" id="editStatement" name="Statement" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Type_incident">Type of Incident</label>
                        <select name="Type_incident" class="form-control" id="Type_incident">
                            <option value="Theft">Theft</option>
                            <option value="Assault">Assault</option>
                            <option value="Fraud">Fraud</option>
                        </select>
                    </div>

 <!-- Type of Evidence -->
 <div class="form-group">
            <label for="Type_Evidence">Type of Evidence</label>
            <select class="form-control" id="Type_Evidence" name="Type_Evidence" onchange="toggleEvidenceFields()">
                <option value="">Select Evidence Type</option>
                <option value="Witness">Witness</option>
                <option value="CCTV Footage">CCTV Footage</option>
                <option value="Image">Image</option>
            </select>
        </div>

        <!-- Witness Name Input -->
        <div class="form-group" id="witnessField" style="display: none;">
            <label for="Witness_Name">Witness Name</label>
            <input type="text" class="form-control" id="Witness_Name" name="Witness_Name">
        </div>

        <!-- Evidence Upload Input -->
        <div class="form-group" id="evidenceFileField" style="display: none;">
            <label for="Evidence_File">Upload Evidence (Image/Video)</label>
            <input type="file" class="form-control" id="Evidence_File" name="Evidence_File" accept="image/*,video/*">
        </div>


<!-- Incident Place -->
<div class="form-group">
    <label for="Incident_place">Incident Place</label>
    <input type="text" class="form-control" id="Incident_place" name="Incident_place">
    </div>

<!-- Time of Incident -->
<div class="form-group">
    <label for="Time_incident">Time of Incident</label>
    <input type="datetime-local" class="form-control" id="Time_incident" name="Time_incident">
    </div>

<!-- Name of Accuser -->
<div class="form-group">
    <label for="editName_accuser">Name of Accuser</label>
    <input type="text" class="form-control" id="editName_accuser" name="Name_accuser">
    </div>

<!-- Section of Accuser -->
<div class="form-group">
    <label for="editSection_accuser">Section</label>
    <input type="text" class="form-control" id="editSection_accuser" name="Section_accuser">
    </div>

<!-- Course of Accuser -->
<div class="form-group">
    <label for="editCourse_accuser">Course</label>
    <input type="text" class="form-control" id="editCourse_accuser" name="Course_accuser">
    </div>

<!-- Year of Accuser -->
<div class="form-group">
    <label for="editYear_accuser">Year</label>
    <input type="text" class="form-control" id="editYear_accuser" name="Year_accuser">
    </div>

<!-- Adviser of Accuser -->
<div class="form-group">
    <label for="editAdviser_accuser">Adviser</label>
    <input type="text" class="form-control" id="editAdviser_accuser" name="Adviser_accuser">
    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggleEvidenceFields() {
    var typeEvidence = document.getElementById("editType_Evidence").value;
    document.getElementById("witnessField").style.display = (typeEvidence === "Witness") ? "block" : "none";
    document.getElementById("evidenceFileField").style.display = (typeEvidence === "CCTV Footage" || typeEvidence === "Image") ? "block" : "none";
}
</script>

<!-- View Details Modal -->
<div class="modal fade" id="viewDetailsModal" tabindex="-1" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDetailsModalLabel">User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name of Reporter:</strong> <span id="viewName_report"></span></p>
                <p><strong>Section:</strong> <span id="viewSection_report"></span></p>
                <p><strong>Course:</strong> <span id="viewCourse_report"></span></p>
                <p><strong>Year:</strong> <span id="viewYear_report"></span></p>
                <p><strong>Adviser:</strong> <span id="viewAdviser_report"></span></p>
                <p><strong>Statement:</strong> <span id="viewStatement"></span></p>
                <p><strong>Type of Incident:</strong> <span id="viewType_incident"></span></p>
                <p><strong>Type of Evidence:</strong> <span id="viewType_Evidence"></span></p>
                <p><strong>Incident Place:</strong> <span id="viewIncident_place"></span></p>
                <p><strong>Time of Incident:</strong> <span id="viewTime_incident"></span></p>
                <p><strong>Witness Name:</strong> <span id="viewWitness_Name"></span></p>
                <p><strong>Evidence File:</strong> <span id="viewEvidence_File"></span></p>
                <p><strong>Name of Accuser:</strong> <span id="viewName_accuser"></span></p>
                <p><strong>Year:</strong> <span id="viewYear_accuser"></span></p>
                <p><strong>Course:</strong> <span id="viewCourse_accuser"></span></p>
                <p><strong>Section:</strong> <span id="viewSection_accuser"></span></p>
                <p><strong>Adviser:</strong> <span id="viewAdviser_accuser"></span></p>

            </div>
        </div>
    </div>
</div>
    </div>
  </div>

</main>

<script>
function confirmDelete(event, Case_id) {
    event.preventDefault(); 
    if (confirm("Are you sure you want to delete this record?")) {
        event.target.closest('form').submit(); 
    }
}

function loadEditData(Case_id, Name_report, Section_report, Course_report, Year_report, Adviser_report,
                      Statement, Type_incident, Type_Evidence, Witness_Name,Evidence_File, Incident_place, Time_incident, 
                      Name_accuser, Year_accuser, Course_accuser, Section_accuser, Adviser_accuser) {

    console.log("Loading data for edit:", {Case_id, Name_report, Section_report, Course_report, Year_report, Adviser_report,
        Statement, Type_incident, Type_Evidence, Witness_Name, Incident_place, Time_incident, 
        Name_accuser, Year_accuser, Course_accuser, Section_accuser, Adviser_accuser});

    document.getElementById('editCase_id').value = Case_id || '';
    document.getElementById('editName_report').value = Name_report || '';
    document.getElementById('editSection_report').value = Section_report || '';
    document.getElementById('editCourse_report').value = Course_report || '';
    document.getElementById('editYear_report').value = Year_report || '';
    document.getElementById('editAdviser_report').value = Adviser_report || '';
    document.getElementById('editStatement').value = Statement || '';
    document.getElementById('editType_incident').value = Type_incident || '';
    document.getElementById('editType_Evidence').value = Type_Evidence || '';
    document.getElementById('editWitness_Name').value = Witness_Name || '';
    document.getElementById('editEvidence_File').value = Evidence_File || '';
    document.getElementById('Incident_place').value = Incident_place || '';
    document.getElementById('Time_incident').value = Time_incident || '';
    document.getElementById('editName_accuser').value = Name_accuser || '';
    document.getElementById('editYear_accuser').value = Year_accuser || '';
    document.getElementById('editCourse_accuser').value = Course_accuser || '';
    document.getElementById('editSection_accuser').value = Section_accuser || '';
    document.getElementById('editAdviser_accuser').value = Adviser_accuser || '';
}

function loadViewDetails(Case_id, Name_report, Section_report, Course_report, Year_report, Adviser_report, Statement, Type_incident, Type_Evidence, Incident_place, Time_incident, Witness_Name, Evidence_File, Name_accuser, Year_accuser, Course_accuser, Section_accuser, Adviser_accuser) {
    document.getElementById('viewName_report').textContent = Name_report;
    document.getElementById('viewSection_report').textContent = Section_report;
    document.getElementById('viewCourse_report').textContent = Course_report;
    document.getElementById('viewYear_report').textContent = Year_report;
    document.getElementById('viewAdviser_report').textContent = Adviser_report;
    document.getElementById('viewStatement').textContent = Statement;
    document.getElementById('viewType_incident').textContent = Type_incident;
    document.getElementById('viewType_Evidence').textContent = Type_Evidence;
    document.getElementById('viewIncident_place').textContent = Incident_place;
    document.getElementById('viewTime_incident').textContent = Time_incident;
    document.getElementById('viewWitness_Name').textContent = Witness_Name;
    document.getElementById('viewEvidence_File').textContent = Evidence_File;
    document.getElementById('viewName_accuser').textContent = Name_accuser;
    document.getElementById('viewYear_accuser').textContent = Year_accuser;
    document.getElementById('viewCourse_accuser').textContent = Course_accuser;
    document.getElementById('viewSection_accuser').textContent = Section_accuser;
    document.getElementById('viewAdviser_accuser').textContent = Adviser_accuser;

}
</script>
<!-- Bootstrap & jQuery -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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