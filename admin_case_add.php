<?php
session_start();
include('connect.php');
include('checklog.php');
check_login();

$Case_id = $Statement = $Type_incident = $Name_report = $Section_report = $Course_report = $Year_report = $Adviser_report = $today = $Name_accuser = $Section_accuser = $Course_accuser = $Year_accuser = $Adviser_accuser = $Type_Evidence = $Incident_place = $Time_incident = $Witness_Name = $Evidence_File = '';
$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action == 'create') {
        $Statement = $_POST['Statement'] ?? '';
        $Type_incident = $_POST['Type_incident'] ?? '';
        $Name_report = $_POST['Name_report'] ?? '';
        $Section_report = $_POST['Section_report'] ?? '';
        $Course_report = $_POST['Course_report'] ?? '';
        $Year_report = $_POST['Year_report'] ?? '';
        $Adviser_report = $_POST['Adviser_report'] ?? '';
        $today = $_POST['today'] ?? '';
        $Name_accuser = $_POST['Name_accuser'] ?? '';
        $Section_accuser = $_POST['Section_accuser'] ?? '';
        $Course_accuser = $_POST['Course_accuser'] ?? '';
        $Year_accuser = $_POST['Year_accuser'] ?? '';
        $Adviser_accuser = $_POST['Adviser_accuser'] ?? '';
        $Type_Evidence = $_POST['Type_Evidence'] ?? '';
        $Incident_place = $_POST['Incident_place'] ?? '';
        $Time_incident = $_POST['Time_incident'] ?? '';
        $Witness_Name = $_POST['Witness_Name'] ?? NULL;
        $Evidence_File = NULL;

        // Handle file upload if it's CCTV Footage or Image
        if (isset($_FILES['Evidence_File']) && $_FILES['Evidence_File']['error'] == 0) {
            $targetDir = "/evidencefile";
            $fileName = basename($_FILES['Evidence_File']['name']);
            $targetFilePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

            // Allow only image and video formats
            $allowedTypes = ['jpg', 'jpeg', 'png', 'mp4', 'avi', 'mov'];
            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES['Evidence_File']['tmp_name'], $targetFilePath)) {
                    $Evidence_File = $targetFilePath; // Save file path in database
                } else {
                    $errors[] = "Error uploading file.";
                }
            } else {
                $errors[] = "Invalid file type. Only images and videos are allowed.";
            }
        }

        $stmt = $connect->prepare("INSERT INTO bcp_sms3_case 
        (Statement, Type_incident, Name_report, Section_report, Course_report, Year_report, Adviser_report, today, 
        Name_accuser, Section_accuser, Course_accuser, Year_accuser, Adviser_accuser, Type_Evidence, Witness_Name, 
        Evidence_File, Incident_place, Time_incident) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("ssssssssssssssssss", 
        $Statement, $Type_incident, $Name_report, $Section_report, $Course_report, $Year_report, 
        $Adviser_report, $today, $Name_accuser, $Section_accuser, $Course_accuser, $Year_accuser, 
        $Adviser_accuser, $Type_Evidence, $Witness_Name, $Evidence_File, $Incident_place, $Time_incident);
    
        if ($stmt->execute()) {
            echo "<script>alert('Case Report added successfully!');</script>";
        } else {
            $errors[] = "Error adding case report: " . $stmt->error;
        }
        $stmt->close();
    }
}


if (isset($_GET['query'])) {
    $search = trim($_GET['query']);
    $search = "%$search%"; // Para kahit partial match, makuha

    $query = "SELECT first_name, last_name, year, course, section, adviser 
              FROM bcp_sms3_student 
              WHERE CONCAT(first_name, ' ', last_name) LIKE ? 
              LIMIT 5"; // Limitahan sa 5 results para di mabigat sa server

    $stmt = $connect->prepare($query);
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();

    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }

    echo json_encode($students); // Return JSON response
}

// Fetch data for display
$query = "SELECT Case_id, Statement, Type_incident, Name_report, Section_report, Course_report, Year_report,Adviser_report,today, Name_accuser,Section_accuser,Course_accuser,Year_accuser,Adviser_accuser,Type_Evidence, Witness_Name, Evidence_File, Incident_place, Time_incident FROM bcp_sms3_case";
$result = mysqli_query($connect, $query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" Statement="viewport">
    <title>Case Report</title>

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/case.css" rel="stylesheet">
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
            <h1 class="dashboard">Case Report</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                    <li class="breadcrumb-item active">Case Report</li>
                    <li class="breadcrumb-item active">Add</li>
                </ol>
            </nav>
        </div>

        <div class="card-body">
        <form method="POST" id="form">
    <input type="hidden" name="action" value="create">

    <div class="form-group">
        <label for="Name_report">Reporter Name</label>
        <input class="text1 form-control" id="Name_report" name="Name_report" value="<?php echo htmlspecialchars($Name_report); ?>">
    </div>

    <div class="form-group">
        <label for="Section_report">Section</label>
        <input class="text2 form-control" id="Section_report" name="Section_report" value="<?php echo htmlspecialchars($Section_report); ?>">
    </div>

    <div class="form-group">
        <label for="Course_report">Course</label>
        <select class="text3 form-select" id="Course_report" name="Course_report" value="<?php echo htmlspecialchars($Course_report); ?>">
                     <option value="ICT">ICT</option>
                    <option value="STEM">STEM</option>
                    <option value="GAS">GAS</option>
                    <option value="HE">HE</option>
                    <option value="ABMS">ABMS</option>
                    <option value="BSIT">BSIT</option>
                    <option value="BSTM" >BSTM</option>
                    <option value="BSEDUC">BSEDUC</option>
                            <option value="BSCRIM" >BSCRIM</option>
                            <option value="BSHM">BSHM</option>
                            <option value="BSENTREP">BSENTREP</option>
                            <option value="BSOA">BSOA</option>
                            <option value="BSBA">BSBA</option>
                            <option value="BSP">BSP</option>
                            <option value="BEEd,BPEd& BTLed">BEEd, BPEd & BTLed</option>
                            <option value="BSCpE" >BSCpE</option>

        </select>
    </div>

    <div class="form-group">
        <label for="Year_report" class="text41">Grade/Year</label>
        <select class="text4 form-select" id="Year_report" name="Year_report" value="<?php echo htmlspecialchars($Year_report); ?>">
                    <option value="Grade 11">Grade 11</option>
                    <option value="Grade 12">Grade 12</option>
                    <option value="1styear" >1st Year</option>
                    <option value="2ndyear">2nd Year</option>
                    <option value="3rdyear">3rd Year</option>
                    <option value="4rtyear" >4th Year</option>
    </select>
    </div>

    <div class="form-group">
        <label for="Adviser_report" class="text51">Adviser</label>
        <input class="text5 form-control" id="Adviser_report" name="Adviser_report" value="<?php echo htmlspecialchars($Adviser_report); ?>">
    </div>

    <div class="form-group">
        <label for="today" class="report1">Report</label>
        <input type="datetime-local" class="report form-control" id="today" name="today">
    </div>

    

    <div class="form-group">
        <label for="Statement" class="text61">Statement</label>
        <textarea required class="text6 form-control" id="Statement" name="Statement" rows="4"><?php echo htmlspecialchars($Statement); ?></textarea>
    </div>

    <div class="form-group">
        <label for="Name_accuser" class="text71">Accuser Name</label>
        <input class="text7 form-control" id="Name_accuser" name="Name_accuser" value="<?php echo htmlspecialchars($Name_accuser); ?>">
    </div>

    <div class="form-group">
        <label for="Section_accuser" class="text81">Section</label>
        <input class="text8 form-control" id="Section_accuser" name="Section_accuser" value="<?php echo htmlspecialchars($Section_accuser); ?>">
    </div>

    <div class="form-group">
        <label for="Course_accuser" class="text91">Course</label>
        <select class="text9 form-select" id="Course_accuser" name="Course_accuser" value="<?php echo htmlspecialchars($Course_accuser); ?>">
        <option value="ICT">ICT</option>
                    <option value="STEM">STEM</option>
                    <option value="GAS">GAS</option>
                    <option value="HE">HE</option>
                    <option value="ABMS">ABMS</option>
                    <option value="BSIT">BSIT</option>
                    <option value="BSTM" >BSTM</option>
                    <option value="BSEDUC">BSEDUC</option>
                            <option value="BSCRIM" >BSCRIM</option>
                            <option value="BSHM">BSHM</option>
                            <option value="BSENTREP">BSENTREP</option>
                            <option value="BSOA">BSOA</option>
                            <option value="BSBA">BSBA</option>
                            <option value="BSP">BSP</option>
                            <option value="BEEd,BPEd& BTLed">BEEd, BPEd & BTLed</option>
                            <option value="BSCpE" >BSCpE</option>
    </select>
    </div>

    <div class="form-group">
        <label for="Year_accuser" class="text12">Year/Grade</label>
        <select class="text11 form-select" id="Year_accuser" name="Year_accuser" value="<?php echo htmlspecialchars($Year_accuser); ?>">
        <option value="Grade 11">Grade 11</option>
                    <option value="Grade 12">Grade 12</option>
                    <option value="1styear" >1st Year</option>
                    <option value="2ndyear">2nd Year</option>
                    <option value="3rdyear">3rd Year</option>
                    <option value="4rtyear" >4th Year</option>
        </select>
    </div>

    <div class="form-group">
        <label for="Adviser_accuser" class="text23">Adviser Name</label>
        <input class="text22 form-control" id="Adviser_accuser" name="Adviser_accuser" value="<?php echo htmlspecialchars($Adviser_accuser); ?>">
    </div>

    <div class="form-group">
        <label for="Type_incident">Type of Incident</label>
        <select name="Type_incident" class="form-control" id="Type_incident">
            <option value="Theft">Theft</option>
            <option value="Assault">Assault</option>
            <option value="Fraud">Fraud</option>
        </select>
    </div>



    <div class="form-group">
    <label for="Type_Evidence">Type of Evidence</label>
    <select class="form-control" id="Type_Evidence" name="Type_Evidence" onchange="toggleEvidenceFields()">
        <option value="">Select Evidence Type</option>
        <option value="Witness">Witness</option>
        <option value="CCTV Footage">CCTV Footage</option>
        <option value="Image">Image</option>
    </select>
</div>

<!-- Input for Witness Name -->
<div class="form-group" id="witnessField" style="display: none;">
    <label for="Witness_Name">Witness Name</label>
    <input type="text" class="form-control" id="Witness_Name" name="Witness_Name">
</div>

<!-- File Upload for CCTV Footage or Image -->
<div class="form-group" id="evidenceFileField" style="display: none;">
    <label for="Evidence_File">Upload Evidence (Image/Video)</label>
    <input type="file" class="form-control" id="Evidence_File" name="Evidence_File" accept="image/*,video/*">
</div>

<script>
    function toggleEvidenceFields() {
        let type = document.getElementById("Type_Evidence").value;
        document.getElementById("witnessField").style.display = (type === "Witness") ? "block" : "none";
        document.getElementById("evidenceFileField").style.display = (type === "CCTV Footage" || type === "Image") ? "block" : "none";
    }
</script>

    <div class="form-group">
        <label for="Incident_place">Incident Place</label>
        <input class="text form-control" id="Incident_place" name="Incident_place" value="<?php echo htmlspecialchars($Incident_place); ?>">
    </div>

    <div class="form-group">
        <label for="Time_incident">Time of Incident</label>
        <input type="datetime-local" class="form-control" id="Time_incident" name="Time_incident">
    </div>

    <script>
    function confirmSubmission(event) {
        event.preventDefault(); // Prevent form submission
        let confirmation = confirm("Are you sure you want to submit this case report?");
        if (confirmation) {
            document.getElementById("form").submit(); // Submit the form if confirmed
        }
    }
</script>

<form method="POST" id="form" onsubmit="confirmSubmission(event)">
    <input type="hidden" name="action" value="create">

    <!-- Form Fields Here -->

    <button type="button" class="btn btn-success" onclick="showConfirmation()">Add Report Cases</button>

</form>


    </main>

    <!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Submission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to submit this case report?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="confirmSubmit">Yes, Submit</button>
            </div>
        </div>
    </div>
</div>


    <?php include('C:\xampp\htdocs\Prefect\inc\footer.php'); ?>

    <script>
    function showConfirmation() {
        let confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
        confirmModal.show();
    }

    document.getElementById('confirmSubmit').addEventListener('click', function () {
        document.getElementById('form').submit();
    });

    

function fetchStudentInfo(fieldId, yearId, courseId, sectionId) {
    let studentName = document.getElementById(fieldId).value;

    if (studentName.trim() !== "") {
        fetch(`get_student_info.php?name=${studentName}`)
        .then(response => response.json())
        .then(data => {
            if (!data.error) {
                document.getElementById(yearId).value = data.year;
                document.getElementById(courseId).value = data.course;
                document.getElementById(sectionId).value = data.section;
            } else {
                alert("Student not found!");
            }
        })
        .catch(error => console.error("Error fetching student info:", error));
    }
}

// Event Listeners para awtomatikong mag-load ng data
document.getElementById("Name_report").addEventListener("blur", function() {
    fetchStudentInfo("Name_report", "Student_number_report", "Year_report", "Course_report", "Section_report");
});

document.getElementById("Name_accuser").addEventListener("blur", function() {
    fetchStudentInfo("Name_accuser", "Student_number_accuser", "Year_accuser", "Course_accuser", "Section_accuser");
});
</script>

    


</script>



       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
