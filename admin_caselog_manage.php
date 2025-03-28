<?php
session_start();
include('connect.php');
include('checklog.php');
check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];


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
        <th data-sortable="true">Severity</th>
        <th data-sortable="true">Penalties</th>
        <th data-sortable="true">Date</th>
        <th data-sortable="true">Status</th>
        <th data-sortable="false">Action</th>  <!-- Disable sorting for actions -->
    </tr>
</thead>
                                <tbody>
                                <?php
                                $ret = "SELECT * FROM bcp_sms_log";
                                $stmt = $connect->prepare($ret);
                                $stmt->execute();
                                $res = $stmt->get_result();
                                $cnt = 1;

                                if ($res->num_rows > 0) {
                                    while ($row = $res->fetch_object()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt++; ?></td>
                                            <td><?php echo htmlspecialchars($row->Studentnumber_Id); ?></td>
                                            <td><?php echo htmlspecialchars($row->Nameid); ?></td>
                                            <td><?php echo htmlspecialchars($row->yearid); ?></td>
                                            <td><?php echo htmlspecialchars($row->courseid); ?></td>
                                            <td><?php echo htmlspecialchars($row->severityid); ?></td>
                                            <td><?php echo htmlspecialchars($row->penalties); ?></td>
                                            <td><?php echo htmlspecialchars($row->date_created); ?></td>
                                            <td>
    <?php
    // Determine the badge class based on the status
    $status = htmlspecialchars($row->Status);
    if ($status == 'Active') {
        echo "<span class='badge bg-danger'>$status</span>"; // Red for Active
    } elseif ($status == 'Resolved') {
        echo "<span class='badge bg-success'>$status</span>"; // Green for Resolved
    } elseif ($status == 'Pending') {
        echo "<span class='badge bg-warning'>$status</span>"; // Orange for Pending
    }
    ?>
</td>

                                            <td>
                                                <button class='btn btn-warning btn-sm editBtn' data-bs-toggle='modal' data-bs-target='#editModal'
                                                    data-studentnumber_id='<?php echo $row->Studentnumber_Id; ?>'
                                                    data-Nameid='<?php echo $row->Nameid; ?>'
                                                    data-yearid='<?php echo $row->yearid; ?>' 
                                                    data-courseid='<?php echo $row->courseid; ?>'
                                                    data-severityid='<?php echo $row->severityid; ?>'
                                                    data-penalties='<?php echo $row->penalties; ?>'
                                                    data-Status='<?php echo $row->Status; ?>'>
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
                    <input type="hidden" name="Studentnumber_Id" id="editStudentnumber_Id">
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
                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Status</label>
                        <select class="form-select" id="editStatus" name="Status" onchange="updateStatusColor()">
                            <option value="Active">Active</option>
                            <option value="Resolved">Resolved</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
            
                    <div id="statusBadgeContainer" class="mt-3">
                        <span id="statusBadge" class="badge">Select Status</span>
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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$('#editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var studentnumber = button.data('studentnumber_id');
    var Name = button.data('Nameid');
    var year = button.data('yearid');
    var course = button.data('courseid');
    var section = button.data('sectionid');
    var severity = button.data('severityid');
    var offence = button.data('offencesid');
    var involve = button.data('involve');
    var penalties = button.data('penalties');
    var status = button.data('Status');

    // Populate the modal fields with data
    $('#editStudentnumber_Id').val(studentnumber);
    $('#editNameid').val(Name);
    $('#edityearid').val(year);
    $('#editcourseid').val(course);
    $('#editSectionid').val(section);  // Corrected case sensitivity
    $('#editseverityid').val(severity);
    $('#editOffencesid').val(offence); // Corrected case sensitivity
    $('#editInvolve').val(involve); // Corrected case sensitivity
    $('#editPenalties').val(penalties); // Corrected case sensitivity
    $('#editStatus').val(status);  // Set the status field

    updateStatusColor(); // Call this function to update the badge color based on the status
});


    function updateStatusColor() {
    var status = $('#editStatus').val();
    var badge = $('#statusBadge');
    
    if (status === 'Active') {
        badge.removeClass('bg-success bg-warning').addClass('bg-danger');
        badge.text('Active');
    } else if (status === 'Resolved') {
        badge.removeClass('bg-danger bg-warning').addClass('bg-success');
        badge.text('Resolved');
    } else if (status === 'Pending') {
        badge.removeClass('bg-danger bg-success').addClass('bg-warning');
        badge.text('Pending');
    }
}
 // AJAX for updating incident data
$('#editForm').on('submit', function(e) {
    e.preventDefault(); // Prevent form submission

    var formData = $(this).serialize(); // Serialize form data

    $.ajax({
        type: 'POST',
        url: 'caselog_update.php', // PHP file that handles the update logic
        data: formData,
        success: function(response) {
            alert(response); // Show success message
            $('#editModal').modal('hide'); // Close modal

            // Reload the table with updated data
            loadTableData();
        },
        error: function() {
            alert('Error updating incident.');
        }
    });
});

// Load table data with updated incident
function loadTableData() {
    $.ajax({
        url: 'caselog_fetch_data.php', // PHP file to fetch updated data
        method: 'GET',
        success: function(data) {
            $('table tbody').html(data); // Update table body with new data
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