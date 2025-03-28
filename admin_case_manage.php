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
        $Name_accuser = $_POST['Name_accuser'];
        $Year_accuser = $_POST['Year_accuser'];
        $Course_accuser = $_POST['Course_accuser'];
        $Section_accuser = $_POST['Section_accuser'];

        $stmt = $connect->prepare("UPDATE bcp_sms3_case SET Name_accuser = ?, Year_accuser = ?, Course_accuser = ?, Section_accuser = ? WHERE Case_id = ?");
        $stmt->bind_param("ssssi", $Name_accuser, $Year_accuser, $Course_accuser, $Section_accuser, $Case_id);
        if ($stmt->execute()) {
            $_SESSION['message'] = 'Account updated successfully!';
        } else {
            $_SESSION['message'] = 'Error updating account.';
        }
        $stmt->close();
    }
}

// Query to fetch user data
$query = "SELECT Case_id, Name_accuser, Year_accuser, Course_accuser, Section_accuser FROM bcp_sms3_case";
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
  <title>User Log</title>

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
      <h1 class="dashboard">User  Log</h1>
      <nav>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
              <li class="breadcrumb-item active">User  Log</li>
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
                          <th>Name</th>
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
                    <!-- Edit Button -->
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal" 
                            onclick="loadEditData('<?php echo $row->Case_id; ?>', '<?php echo addslashes($row->Name_accuser); ?>', '<?php echo addslashes($row->Year_accuser); ?>', '<?php echo addslashes($row->Course_accuser); ?>', '<?php echo addslashes($row->Section_accuser); ?>')">Edit</button>
                    <!-- Delete Button -->
                    <form method="POST" style="display:inline-block;" Case_id="deleteForm_<?php echo $row->Case_id; ?>" onsubmit="return confirmDelete('<?php echo $row->Case_id; ?>');">
                        <input type="hidden" name="Case_id" value='<?php echo $row->Case_id; ?>'>
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit User Information</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="">
            <input type="hidden" name="Case_id" id="editCase_id">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" id="editName_accuser" name="Name_accuser" required>
            </div>
            <div class="form-group">
              <label>Year</label>
              <input type="text" class="form-control" id="editYear_accuser" name="Year_accuser" required>
            </div>
            <div class="form-group">
              <label>Course</label>
              <input type="text" class="form-control" id="editCourse_accuser" name="Course_accuser" required>
            </div>
            <div class="form-group">
              <label>Section</label>
              <input type="text" class="form-control" id="editSection_accuser" name="Section_accuser" required>
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</main>

<script>
function confirmDelete(Case_id) {
    return confirm("Are you sure you want to delete this record?");
}

function loadEditData(Case_id, name, year, course, section) {
    document.getElementByCase_id('editCase_id').value = Case_id;
    document.getElementByCase_id('editName_accuser').value = name;
    document.getElementByCase_id('editYear_accuser').value = year;
    document.getElementByCase_id('editCourse_accuser').value = course;
    document.getElementByCase_id('editSection_accuser').value = section;
}
</script>

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