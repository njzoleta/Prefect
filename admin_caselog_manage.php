<?php
session_start();
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Studentnumber_id = $_POST['Studentnumber_id'];
    $Nameid = $_POST['Nameid'];
    $yearid = $_POST['yearid'];
    $courseid = $_POST['courseid'];
    $sectionid = $_POST['sectionid'];
    $severityid = $_POST['severityid'];
    $offencesid = $_POST['offencesid'];
    $involve = $_POST['involve'];
    $penalties = $_POST['penalties'];

    // SQL Query
    $query = "UPDATE bcp_sms_log SET 
        Nameid = ?, 
        yearid = ?, 
        courseid = ?, 
        sectionid = ?, 
        severityid = ?, 
        offencesid = ?, 
        involve = ?, 
        penalties = ?, 
      WHERE Studentnumber_id = ?";

    // Prepared Statement
    $stmt = $connect->prepare($query);
    if (!$stmt) {
        die(json_encode(["status" => "error", "message" => "Database error: " . $connect->error]));
    }

    $stmt->bind_param('sssssssssi', $Nameid, $yearid, $courseid, $sectionid, $severityid, $offencesid, $involve, $penalties, $Studentnumber_id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Incident updated successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating incident: " . $stmt->error]);
    }

    $stmt->close();
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
</head>

<body>

<?php include('C:\xampp\htdocs\Prefect\inc\header.php'); ?>
<?php include('C:\xampp\htdocs\Prefect\inc\adminsidebar.php'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="dashboard">Incident Log</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                <li class="breadcrumb-item active">Incident Log</li>
                <li class="breadcrumb-item active">Manage</li>
            </ol>
        </nav>
    </div>

    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Student Incident Log
                </div>
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <?php
                            // Display success or error message
                            if (isset($_SESSION['message'])) {
                                echo "<div class='alert alert-info'>" . $_SESSION['message'] . "</div>";
                                unset($_SESSION['message']);
                            }
                            ?>
                            <table class="table table-borderless datatable">
                            <thead>
    <tr>
        <th data-sortable="true">#</th>
        <th data-sortable="true">Student number</th>
        <th data-sortable="true">Name</th>
        <th data-sortable="true">Year</th>
        <th data-sortable="true">Course</th>
        <th data-sortable="true">Section</th>
        <th data-sortable="true">Severity</th>
        <th data-sortable="true">Penalties</th>
        <th data-sortable="true">Date</th>
        <th data-sortable="false">Action</th>  <!-- Disable sorting for actions -->
    </tr>
</thead>
                                <tbody>
                                <?php
   $ret = "SELECT * FROM bcp_sms_log";
   $stmt = $connect->prepare($ret);
   $stmt->execute();  // ✅ Dapat i-execute ang query bago kunin ang result
   $res = $stmt->get_result();
   
   // Huwag munang i-close ang connection dito!
   
                                $cnt = 1;

                                if ($res->num_rows > 0) {
                                    while ($row = $res->fetch_object()) {
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
                                            <td><?php echo htmlspecialchars($row->date_created); ?></td>
                                            

<td>
<button class='btn btn-info btn-sm viewBtn' 
    data-bs-toggle='modal' data-bs-target='#viewDetailsModal'
    data-studentnumber_id="<?= htmlspecialchars($row->Studentnumber_id); ?>"
    data-nameid="<?= htmlspecialchars($row->Nameid); ?>"
    data-yearid="<?= htmlspecialchars($row->yearid); ?>"
    data-courseid="<?= htmlspecialchars($row->courseid); ?>"
    data-sectionid="<?= htmlspecialchars($row->sectionid); ?>"
    data-adviser_name="<?= htmlspecialchars($row->adviser_name); ?>"
    data-parent_name="<?= htmlspecialchars($row->parent_name); ?>"
    data-parent_contact="<?= htmlspecialchars($row->parent_contact); ?>"
    data-severityid="<?= htmlspecialchars($row->severityid); ?>"
    data-offencesid="<?= htmlspecialchars($row->offencesid); ?>"
    data-evidence_type="<?= htmlspecialchars($row->evidence_type); ?>"
    data-witness_name="<?= htmlspecialchars($row->witness_name); ?>"
    data-witness_statement="<?= htmlspecialchars($row->witness_statement); ?>"
    data-evidence_file="<?= htmlspecialchars($row->evidence_file); ?>"
    data-involve="<?= htmlspecialchars($row->involve); ?>"
    data-penalties="<?= htmlspecialchars($row->penalties); ?>"
    data-statement="<?= htmlspecialchars($row->statement); ?>"
    data-incident_date="<?= htmlspecialchars($row->incident_date); ?>"
    data-category="<?= htmlspecialchars($row->category); ?>"
    data-date_created="<?= htmlspecialchars($row->date_created); ?>">
    View Details
</button>




<button class='btn btn-warning btn-sm editBtn' 
    data-bs-toggle='modal' data-bs-target='#editModal'
    data-Studentnumber_id="<?= htmlspecialchars($row->Studentnumber_id); ?>"
    data-Nameid="<?= htmlspecialchars($row->Nameid); ?>"
    data-yearid="<?= htmlspecialchars($row->yearid); ?>"
    data-courseid="<?= htmlspecialchars($row->courseid); ?>"
    data-sectionid="<?= htmlspecialchars($row->sectionid); ?>"
    data-severityid="<?= htmlspecialchars($row->severityid); ?>"
    data-offencesid="<?= htmlspecialchars($row->offencesid); ?>"
    data-involve="<?= htmlspecialchars($row->involve); ?>"
    data-penalties="<?= htmlspecialchars($row->penalties); ?>">
    Edit
</button>



</td>

                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='12'>No records found.</td></tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('C:\xampp\htdocs\Prefect\inc\footer.php'); ?>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Incident</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editForm">
                    <input type="hidden" name="Studentnumber_id" id="editStudentnumber_id">


                    <div class="mb-3">
                        <label for="editNameid" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editNameid" name="Nameid">
                    </div>
                    <div class="mb-3">
                        <label for="edityearid" class="form-label">Year/Grade</label>
                        <select class="form-select" id="edityearid" name="yearid">
                            <option value="Grade 11">Grade11</option>
                            <option value="Grade12">Grade12</option>
                            <option value="1styear">1st Year</option>
                            <option value="2ndyear">2nd Year</option>
                            <option value="3rdyear">3rd year</option>
                            <option value="4rtyear">4rt Year</option>
                        </select>
                    </div>
                        <div class="mb-3">
                         <label for="editcourseid" class="form-label">Course</label>
                        <select class="form-select" id="editcourseid" name="courseid">
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
                            <option value="BEEd,BPEd& BTLed">BEEd, BPEd & BTLed</option>
                            <option value="BSCpE">BSCpE</option>
                            <option value="BSAIS">BSAIS</option>
                        </select>
            </div>
                    <div class="mb-3">
                        <label for="editseverityid" class="form-label">Severity</label>
                        <select class="form-select" id="editseverityid" name="severityid">
                            <option value="Minor">Minor</option>
                            <option value="Major">Major</option>
                            <option value="Grave">Grave</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editOffencesid" class="form-label">Offence</label>
                        <input type="text" class="form-control" id="editOffencesid" name="offencesid">
                    </div>
                    <div class="mb-3">
                        <label for="editInvolve" class="form-label">Involve</label>
                        <input type="text" class="form-control" id="editInvolve" name="involve">
                    </div>
                    <div class="mb-3">
                        <label for="editPenalties" class="form-label">Penalties</label>
                        <input type="text" class="form-control" id="editPenalties" name="penalties">
                    </div>

            

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Details Modal -->
<div class="modal fade" id="viewDetailsModal" tabindex="-1" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDetailsModalLabel">Incident Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Student Number:</strong> <span id="viewStudentnumber_id"></span></p>
                <p><strong>Name:</strong> <span id="viewNameid"></span></p>
                <p><strong>Year:</strong> <span id="viewyearid"></span></p>
                <p><strong>Course:</strong> <span id="viewcourseid"></span></p>
                <p><strong>Section:</strong> <span id="viewsectionid"></span></p>
                <p><strong>Adviser Name:</strong> <span id="viewadviser_name"></span></p>
                <p><strong>Parent Name:</strong> <span id="viewparent_name"></span></p>
                <p><strong>Parent Contact:</strong> <span id="viewparent_contact"></span></p>
                <p><strong>Severity:</strong> <span id="viewseverityid"></span></p>
                <p><strong>Offence:</strong> <span id="viewoffencesid"></span></p>
                <p><strong>Evidence Type:</strong> <span id="viewevidence_type"></span></p>
                <p><strong>Witness Name:</strong> <span id="viewwitness_name"></span></p>
                <p><strong>Witness Statement:</strong> <span id="viewwitness_statement"></span></p>
                <p><strong>Evidence File:</strong> <a id="viewevidence_file" href="#" target="_blank">View File</a></p>
                <p><strong>Involve:</strong> <span id="viewinvolve"></span></p>
                <p><strong>Penalties:</strong> <span id="viewpenalties"></span></p>
                <p><strong>Statement:</strong> <span id="viewstatement"></span></p>
                <p><strong>Incident Date:</strong> <span id="viewincident_date"></span></p>
                <p><strong>Category:</strong> <span id="viewcategory"></span></p>
                <p><strong>Date Created:</strong> <span id="viewdate_created"></span></p>
            </div>
        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$('#viewDetailsModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);

    var Studentnumber = button.data('studentnumber_id');
    var Name = button.data('nameid');
    var year = button.data('yearid');
    var course = button.data('courseid');
    var section = button.data('sectionid');
    var adviser_name = button.data('adviser_name');
    var parent_name = button.data('parent_name');
    var parent_contact = button.data('parent_contact');
    var severity = button.data('severityid');
    var offence = button.data('offencesid');
    var evidence_type = button.data('evidence_type');
    var witness_name = button.data('witness_name');
    var witness_statement = button.data('witness_statement');
    var evidence_file = button.data('evidence_file');
    var involve = button.data('involve');
    var penalties = button.data('penalties');
    var statement = button.data('statement');
    var incident_date = button.data('incident_date');
    var category = button.data('category');
    var date_created = button.data('date_created');

    $('#viewStudentnumber_id').text(Studentnumber);
    $('#viewNameid').text(Name);
    $('#viewyearid').text(year);
    $('#viewcourseid').text(course);
    $('#viewsectionid').text(section);
    $('#viewadviser_name').text(adviser_name);
    $('#viewparent_name').text(parent_name);
    $('#viewparent_contact').text(parent_contact);
    $('#viewseverityid').text(severity);
    $('#viewoffencesid').text(offence);
    $('#viewevidence_type').text(evidence_type);
    $('#viewwitness_name').text(witness_name);
    $('#viewwitness_statement').text(witness_statement);
    
    if (evidence_file) {
        $('#viewevidence_file').attr('href', 'uploads/' + evidence_file).text("View File");
    } else {
        $('#viewevidence_file').attr('href', '#').text("No file");
    }

    $('#viewinvolve').text(involve);
    $('#viewpenalties').text(penalties);
    $('#viewstatement').text(statement);
    $('#viewincident_date').text(incident_date);
    $('#viewcategory').text(category);
    $('#viewdate_created').text(date_created);
});





$('#editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);

    var Studentnumber = button.data('Studentnumber_id');
    var Name = button.data('Nameid');
    var year = button.data('yearid');
    var course = button.data('courseid');
    var section = button.data('sectionid');
    var severity = button.data('severityid');
    var offence = button.data('offencesid');
    var involve = button.data('involve');
    var penalties = button.data('penalties');
  

    // Populate fields
    $('#editStudentnumber_id').val(Studentnumber);
    $('#editNameid').val(Name);
    $('#edityearid').val(year);
    $('#editcourseid').val(course);
    $('#editSectionid').val(section);
    $('#editseverityid').val(severity);
    $('#editOffencesid').val(offence);
    $('#editInvolve').val(involve);
    $('#editPenalties').val(penalties);

});




 // AJAX para sa pag-update ng incident
$('#editForm').on('submit', function(e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.post('admin_caselog_update.php', formData, function(response) {
        var data = JSON.parse(response);
        alert(data.message);

        if (data.status === "success") {
            $('#editModal').modal('hide'); // Isara ang modal
            loadTableData(); // I-refresh ang table
        }
    }).fail(function() {
        alert('Error updating incident.');
    });
});

// Function para i-refresh ang table data
function loadTableData() {
    $.ajax({
        url: 'admin_caselog_fetch.php',
        method: 'GET',
        success: function(data) {
            $('table tbody').html(data); // Ina-update ang table body
        }
    });
}




document.addEventListener("DOMContentLoaded", function () {
    var table = new simpleDatatables.DataTable(".datatable", {
        searchable: true, // Enables search
        fixedHeight: true, // Fixes height for better UI
        perPage: 10, // Number of records per page
        sortable: true, // Enables sorting
        labels: {
            placeholder: "Search...", // Search placeholder text
            perPage: "Show {select} entries", // Per-page dropdown
            noRows: "No records found", // Message when no rows exist
            info: "Showing {start} to {end} of {rows} entries" // Info text
        }
    });
});


</script>

<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>