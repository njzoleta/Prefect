<?php
session_start();
include('connect.php');
include('checklog.php');
check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        // Handle delete request
        $AccountId = $_POST['AccountId'];
        $stmt = $connect->prepare("DELETE FROM bcp_sms3_admin WHERE AccountId = ?");
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
        $password = $_POST['password'];

        $stmt = $connect->prepare("UPDATE bcp_sms3_admin SET name = ?, password = ? WHERE AccountId = ?");
        $stmt->bind_param("sss", $name, $password, $AccountId);
        if ($stmt->execute()) {
            $_SESSION['message'] = 'Account updated successfully!';
        } else {
            $_SESSION['message'] = 'Error updating account.';
        }
        $stmt->close();
    }
}

// Fix the SQL query to ensure it fetches AccountId
$query = "SELECT AccountId, name, password FROM bcp_sms3_admin";  // Added AccountId column explicitly
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
  <title>Admin Log</title>

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
<!-- End Sidebar -->

<main id="main" class="main">
  <div class="pagetitle">
    <h1 class="dashboard">Admin Log</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
        <li class="breadcrumb-item active">Admin Log</li>
        <li class="breadcrumb-item active">Manage</li>
      </ol>
    </nav>
  </div>   

  <div id="content-wrapper">
    <div class="container-fluid">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i> Admin Log
        </div>
        <div class="col-12">
          <div class="card recent-sales overflow-auto">
            <div class="card-body">
              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Id Number</th>
                    <th>Name</th>
                    <th>Password</th>
                    <th>Action</th>
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
                <td><?php echo htmlspecialchars($row->password); ?></td>

                <td>
                    <!-- Edit Button -->
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal" 
                            onclick="loadEditData('<?php echo $row->AccountId; ?>', '<?php echo addslashes($row->name); ?>', '<?php echo addslashes($row->password); ?>')">Edit</button>
                            <form method="POST" style="display:inline-block;" id="deleteForm_<?php echo $row->AccountId; ?>" onsubmit="return confirmDelete(<?php echo $row->AccountId; ?>);">
    <input type="hidden" name="AccountId" value='<?php echo $row->AccountId; ?>'>
    <input type="hidden" name="action" value="delete">
    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
</form>

<script>
function confirmDelete(AccountId) {
    // Display confirmation dialog before form submission
    var confirmation = confirm("Are you sure you want to delete this admin account?");
    if (confirmation) {
        // If user clicks "OK", submit the form
        document.getElementById('deleteForm_' + AccountId).submit();
    } else {
        // If user clicks "Cancel", prevent form submission
        return false;
    }
}
</script>



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
      </div>
    </div>
</main>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editForm">
                    <div class="mb-3">
                        <label for="editAccountId" class="form-label">Id Number</label>
                        <input type="text" class="form-control" id="editAccountId" name="AccountId" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="editname" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="editname" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="editpassword" class="form-label">Password</label>
                        <input type="Password" class="form-control" id="editpassword" name="password">
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

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Admin Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Admin Account?</p>
            </div>
            <div class="modal-footer">
                <form method="POST" id="deleteForm">
                    <input type="hidden" name="AccountId" id="deleteAccountId">
                    <input type="hidden" name="action" value="delete">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('C:\xampp\htdocs\Prefect\inc\footer.php'); ?>
<script>
function loadEditData(AccountId, name, password) {
  document.getElementById('editAccountId').value = AccountId;
  document.getElementById('editname').value = name;
  document.getElementById('editpassword').value = password;

  // Manually trigger the modal display (for Bootstrap 5)
  var editModal = new bootstrap.Modal(document.getElementById('editModal'));
  editModal.show();
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
