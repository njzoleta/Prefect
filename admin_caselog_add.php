<?php
session_start();
include('connect.php'); 
include('checklog.php');
check_login();

$Studentnumber_Id = $Nameid = $yearid = $courseid = $sectionid = $severityid = $offencesid = $evidence_type = $witness_name = $witness_statement = $involve = $penalties = $statement = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addincident'])) {
    $Studentnumber_Id = $_POST['Studentnumber_Id'] ?? '';
    $Nameid = $_POST['Nameid'] ?? '';
    $yearid = $_POST['yearid'] ?? '';
    $courseid = $_POST['courseid'] ?? '';
    $sectionid = $_POST['sectionid'] ?? '';
    $severityid = $_POST['severityid'] ?? '';
    $offencesid = $_POST['offencesid'] ?? '';
    $involve = $_POST['involve'] ?? '';
    $penalties = $_POST['penalties'] ?? '';
    $statement = $_POST['statement'] ?? '';
    $evidence_type = $_POST['evidence_type'] ?? '';

    $category = (in_array($yearid, ['Grade 11', 'Grade 12'])) ? 'Senior High' : 'College';

    // Ensure incident_date is properly set
    $incident_date = $_POST['date_created'] ?? null;
    if (!empty($incident_date)) {
        $incident_date = date('Y-m-d H:i:s', strtotime($incident_date));
    } else {
        die("Error: Incident Date is required."); // Stop execution if incident_date is missing
    }

    $witness_name = null;
    $witness_statement = null;
    
    if ($evidence_type == "Witness") {
        $witness_name = $_POST['witness_name'] ?? '';
        $witness_statement = $_POST['witness_statement'] ?? '';
    }

    if (empty($errors)) {
        $stmt = $connect->prepare("INSERT INTO bcp_sms_log 
            (Studentnumber_Id, Nameid, yearid, courseid, sectionid, severityid, offencesid, evidence_type, witness_name, witness_statement, involve, penalties, statement, date_created, incident_date, category) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?)");

        if (!$stmt) {
            die("Prepare failed: " . $connect->error);
        }

        $stmt->bind_param("sssssssssssssss", 
            $Studentnumber_Id, $Nameid, $yearid, $courseid, $sectionid, $severityid, $offencesid, 
            $evidence_type, $witness_name, $witness_statement, $involve, $penalties, $statement, $incident_date, $category);

        if (!$stmt->execute()) {
            die("Execution failed: " . $stmt->error);
        }

        echo "<script>alert('Incident logged successfully!');</script>";
        $stmt->close();
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
             
            <label for="Category_accuser">Category</label>
        <select id="Category_accuser" name="Category_accuser" class="form-control">
            <option value="Senior High">Senior High</option>
            <option value="College">College</option>
        </select>
            <div class="form-group">
                <label for="Studentnumber_Id">Student Number</label>
                <input type="text" required class="form-control" id="Studentnumber_Id" name="Studentnumber_Id" value="<?php echo htmlspecialchars($Studentnumber_Id); ?>">
                </div>
            <div class="form-group">
                <label for="Nameid">Full Name</label>
                <input type="text" class="form-control" id="Nameid" name="Nameid" value="<?php echo htmlspecialchars($Nameid); ?>" onkeyup="fetchStudentData()">
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
                <label for="adviser_name">Adviser's Name</label>
                <input type="text" class="form-control" id="adviser_name" name="adviser_name" readonly>
            </div>

            <h5>Parent Information</h5>
            <div class="form-group">
                <label for="guardian_name">Guardian's Name</label>
                <input type="text" class="form-control" id="guardian_name" name="guardian_name" readonly>
            </div>
            <div class="form-group">
                <label for="guardian_contact">Guardian's Contact</label>
                <input type="text" class="form-control" id="guardian_contact" name="guardian_contact" readonly>
            </div>

                <div class="form-group">
        <label for="editseverityid">Severity</label>
        <select class="form-select" id="editseverityid" name="severityid" onchange="loadOffences()">
            <option value="Minor">Minor</option>
            <option value="Major">Major</option>
            <option value="Grave">Grave</option>
        </select>
    </div>

    <div class="form-group">
        <label for="offencesid">Offences</label>
        <select class="form-select" id="offencesid" name="offencesid">
            <option value="">Select an offence</option>
        </select>
    </div>

    <div class="form-group">
    <label for="evidence_type">Type of Evidence</label>
    <select class="form-select" id="evidence_type" name="evidence_type" onchange="toggleEvidenceField()">
        <option value="">Select Evidence Type</option>
        <option value="Witness">Witness Statement</option>
        <option value="CCTV">CCTV Footage</option>
        <option value="Image">Image</option>
    </select>
</div>

<!-- Witness Name Input -->
<div class="form-group" id="witness_name_group" style="display: none;">
    <label for="witness_name">Witness Name</label>
    <input type="text" class="form-control" id="witness_name" name="witness_name">
</div>

<!-- Witness Statement Input -->
<div class="form-group" id="witness_statement_group" style="display: none;">
    <label for="witness_statement">Witness Statement</label>
    <textarea class="form-control" id="witness_statement" name="witness_statement" rows="3"></textarea>
</div>

<!-- CCTV File Upload -->
<div class="form-group" id="cctv_upload_group" style="display: none;">
    <label for="evidence_file">Upload CCTV Footage</label>
    <input type="file" class="form-control" id="evidence_file" name="evidence_file" accept="video/*">
</div>

<!-- Image File Upload -->
<div class="form-group" id="image_upload_group" style="display: none;">
    <label for="evidence_file">Upload Image Evidence</label>
    <input type="file" class="form-control" id="evidence_file" name="evidence_file" accept="image/*">
</div>

<script>
    function toggleEvidenceField() {
        var evidenceType = document.getElementById("evidence_type").value;
        
        // Hide all fields first
        document.getElementById("witness_name_group").style.display = "none";
        document.getElementById("witness_statement_group").style.display = "none";
        document.getElementById("cctv_upload_group").style.display = "none";
        document.getElementById("image_upload_group").style.display = "none";

        // Show the selected evidence input
        if (evidenceType === "Witness") {
            document.getElementById("witness_name_group").style.display = "block";
            document.getElementById("witness_statement_group").style.display = "block";
        } else if (evidenceType === "CCTV") {
            document.getElementById("cctv_upload_group").style.display = "block";
        } else if (evidenceType === "Image") {
            document.getElementById("image_upload_group").style.display = "block";
        }
    }
</script>


            <div class="form-group">
                <label for="involve">Involve</label>
                <input type="text" class="form-control" id="involve" name="involve" value="<?php echo htmlspecialchars($involve); ?>">
            </div>
            <div class="form-group">
                <label for="penalties">Penalties</label>
                <input type="text" class="form-control" id="penalties" name="Penalties" value="<?php echo htmlspecialchars($penalties); ?>">
            </div>

            <div class="form-group">
        <label for="Statement" class="text61">Statement</label>
        <textarea required class="text6 form-control" id="Statement" name="Statement" rows="4"><?php echo htmlspecialchars($statement); ?></textarea>
    </div>

    <div class="form-group">
            <label for="date_created">Today Report Date & Time</label>
            <input type="datetime-local" class="form-control" id="date_created" name="date_created" required>
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

<script>
document.getElementById("Studentnumber_Id").addEventListener("blur", function() {
    let studentNumber = this.value.trim();
    
    if (studentNumber !== "") {
        fetch(`fetch_studentinfo.php?student_number=${encodeURIComponent(studentNumber)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                alert("Student not found! Please check the Student Number.");
            } else {
                fillStudentData(data);
            }
        })
        .catch(error => console.error("Error fetching student info:", error));
    }
});

function fillStudentData(student) {
    document.getElementById("Nameid").value = student.first_name + " " + student.last_name;
    document.getElementById("edityearid").value = student.year || "";
    document.getElementById("editcourseid").value = student.course;
    document.getElementById("sectionid").value = student.section;
    document.getElementById("adviser_name").value = student.adviser || "";
    document.getElementById("guardian_name").value = student.guardian_name || "";
    document.getElementById("guardian_contact").value = student.guardian_contact || "";
}

</script>


<script>
function loadOffences() {
    let severity = document.getElementById("editseverityid").value;
    let offencesDropdown = document.getElementById("offencesid");

    offencesDropdown.innerHTML = '<option value="">Loading...</option>'; // Show loading state

    fetch(`fetch_offence.php?severity=${severity}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log("Received data:", data); // Debugging log
            offencesDropdown.innerHTML = '<option value="">Select an offence</option>'; // Reset options

            if (data.error) {
                alert("Error: " + data.error);
                return;
            }

            if (data.length === 0) {
                alert("No offences found for this severity.");
                return;
            }

            data.forEach(offence => {
                let option = document.createElement("option");
                option.value = offence.code;
                option.textContent = `${offence.code} - ${offence.description}`;
                offencesDropdown.appendChild(option);
            });
        })
        .catch(error => {
            console.error("Fetch error:", error);
            alert("Failed to fetch offences. Please check console for details.");
        });
}


</script>





<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
