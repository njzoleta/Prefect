<?php
session_start();
include('connect.php'); 
include('checklog.php');
check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        // Handle delete request
        $AccountId = $_POST['AccountId'];
        $stmt = $connect->prepare("DELETE FROM bcp_sms3_user WHERE AccountId = ?");
        $stmt->bind_param("s", $AccountId);
        if ($stmt->execute()) {
            $_SESSION['message'] = 'Account deleted successfully!';
        } else {
            error_log("Database error: " . $stmt->error);
            $_SESSION['message'] = "Error deleting account.";
        }
        $stmt->close();
    }

    // Handle edit request
    if (isset($_POST['AccountId']) && isset($_POST['name'])) {
        $AccountId = $_POST['AccountId'];
        $name = $_POST['name'];
        $year = $_POST['year'];
        $course = $_POST['course'];
        $section = $_POST['section'];
        $password = $_POST['password'];

        $stmt = $connect->prepare("UPDATE bcp_sms3_user SET name = ?, year = ?, course = ?, section = ? , password =? WHERE AccountId = ?");
        $stmt->bind_param("ssssss", $name, $year, $course, $section,$password , $AccountId);
        if ($stmt->execute()) {
            $_SESSION['message'] = 'Account updated successfully!';
        } else {
            $_SESSION['message'] = 'Error updating account.';
        }
        $stmt->close();
    }
}

// Query to fetch user data
$query = "SELECT AccountId, name, year, course, section ,password FROM bcp_sms3_user WHERE category = 'User'";
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
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<!-- Header -->
<?php include('C:\xampp\htdocs\Prefect\inc\header.php'); ?>
<!-- End Header -->

<!-- Sidebar -->
<?php include('C:\xampp\htdocs\Prefect\inc\adminsidebar.php'); ?>
<!-- End Sidebar -->

<main id="main" class="main">
  <div class="pagetitle">
      <h1 class="dashboard">User Log</h1>
      <nav>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
              <li class="breadcrumb-item active">User Log</li>
              <li class="breadcrumb-item active">View</li>
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
                          <th>Student Number</th>
                          <th>Name</th>
                          <th>Year</th>
                          <th>Course</th>
                          <th>Section</th>
                          <th>Password</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody>
    <?php
    // Check if the query returned results
    if ($result->num_rows > 0) {
        $cnt = 1;
        while ($row = $result->fetch_object()) {
            ?>
            <tr>
                <td><?php echo $cnt++; ?></td>
                <td><?php echo htmlspecialchars($row->AccountId); ?></td>
                <td><?php echo htmlspecialchars($row->name); ?></td>
                <td><?php echo htmlspecialchars($row->year); ?></td>
                <td><?php echo htmlspecialchars($row->course); ?></td>
                <td><?php echo htmlspecialchars($row->section); ?></td>
                <td><?php echo htmlspecialchars($row->password); ?></td>
                <td>
                    <!-- Edit Button -->
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal" 
                            onclick="loadEditData('<?php echo $row->AccountId; ?>', '<?php echo addslashes($row->name); ?>', '<?php echo addslashes($row->year); ?>', '<?php echo addslashes($row->course); ?>', '<?php echo addslashes($row->section); ?>', '<?php echo addslashes($row->password); ?>')">Edit</button>
                    <!-- Delete Button -->
                    <form method="POST" style="display:inline-block;" id="deleteForm_<?php echo $row->AccountId; ?>" onsubmit="return confirmDelete('<?php echo $row->AccountId; ?>');">
                        <input type="hidden" name="AccountId" value='<?php echo $row->AccountId; ?>'>
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
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit User Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="editForm">
            <input type="hidden" name="AccountId" id="editAccountId">
            <div class="form-group">
              <label for="editName">Name</label>
              <input type="text" class="form-control" id="editName" name="name" required>
            </div>
            <div class="form-group">
              <label for="editYear">Year</label>
              <input type="text" class="form-control" id="editYear" name="year" required>
            </div>
            <div class="form-group">
              <label for="editCourse">Course</label>
              <input type="text" class="form-control" id="editCourse" name="course" required>
            </div>
            <div class="form-group">
              <label for="editSection">Section</label>
              <input type="text" class="form-control" id="editSection" name="section" required>
            </div>
            <div class="form-group">
              <label for="editPassword">Password</label>
              <input type="password" class="form-control" id="editPassword" name="password" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include('C:\xampp\htdocs\Prefect\inc\footer.php'); ?>

<script>
function loadEditData(AccountId, name, year, course, section, password) {
  document.getElementById('editAccountId').value = AccountId;
  document.getElementById('editName').value = name;
  document.getElementById('editYear').value = year;
  document.getElementById('editCourse').value = course;
  document.getElementById('editSection').value = section;
  document.getElementById('editPassword').value = password;
  
  // Manually trigger the modal display (for Bootstrap 5)
  var editModal = new bootstrap.Modal(document.getElementById('editModal'));
  editModal.show();
}

function confirmDelete(AccountId) {
    // Ask for confirmation
    var result = confirm("Are you sure you want to delete the account with Student Number: " + AccountId + "?");
    return result; // If the user clicks 'OK', form will be submitted, otherwise, it won't.
}
</script>

<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
