<?php
session_start();
include('connect.php');
include('checklog.php');
check_login();

$minorId = $minor = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'create' || $action == 'update') {
        $minorId = $_POST['minorId'] ?? '';
        $minor = $_POST['minor'] ?? '';

        if ($action == 'create') {
            $stmt = $connect->prepare("INSERT INTO bcp_sms3_minor (minorId, minor) VALUES (?, ?)");
            $stmt->bind_param("ss", $minorId, $minor);
            if ($stmt->execute()) {
                echo "<script>alert('Minor rules added successfully!');</script>";
            } else {
                error_log("Database error: " . $stmt->error);
                $errors[] = "Error adding minor rule.";
            }
            $stmt->close();
        }

        if ($action == 'update') {
            $stmt = $connect->prepare("UPDATE bcp_sms3_minor SET minor=? WHERE minorId=?");
            $stmt->bind_param("ss", $minor, $minorId);
            if ($stmt->execute()) {
                echo "<script>alert('Account updated successfully!');</script>";
            } else {
                error_log("Database error: " . $stmt->error);
                $errors[] = "Error updating account.";
            }
            $stmt->close();
        }
    }

    if ($action == 'delete') {
        $minorId = $_POST['minorId'];
        $stmt = $connect->prepare("DELETE FROM bcp_sms3_minor WHERE minorId = ?");
        $stmt->bind_param("s", $minorId);
        if ($stmt->execute()) {
            echo "<script>alert('Account deleted successfully!');</script>";
        } else {
            error_log("Database error: " . $stmt->error);
            $errors[] = "Error deleting account.";
        }
        $stmt->close();
    }
}

$query = "SELECT minorId, minor FROM bcp_sms3_minor";
$result = mysqli_query($connect, $query);
?>


<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Rules & Violations</title>

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/offense.css" rel="stylesheet">

</head>
<body>


<?php include('C:\xampp\htdocs\Prefect\inc\header.php'); ?>


<?php include('C:\xampp\htdocs\Prefect\inc\adminsidebar.php'); ?>

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Minor Offense</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item">Rules & Violations</li>
          <li class="breadcrumb-item active">Minor Offense</li>
        </ol>
      </nav>
    </div>

    <div class="container mt-5">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>OFFENSE</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                        <td>{$row['minor']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm editBtn' 
                                data-minorid='{$row['minorId']}' 
                                data-minor='{$row['minor']}'>
                                Edit
                            </button>
                            <form method='POST' style='display:inline-block;' onsubmit='return confirm(\"Are you sure you want to delete this?\");'>
                                <input type='hidden' name='minorId' value ='{$row['minorId']}'>
                                <input type='hidden' name='action' value='delete'>
                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                            </form>
                        </td>
                    </tr>";
                    }
                } else {
                    echo "<tr><td colspan='2' class='text-center'>No accounts found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Add Minor Rule</button>

        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Add Minor Rule</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="action" value="create">
                            <div class="form-group">
                                <label>New Minor Rule</label>
                                <input type="text" name="minor" class="form-control" required>
                                <span class="text-danger"><?php echo $minor; ?></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add Minor Rule</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Minor Rule</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="minorId" id="editMinorId">
                            <div class="form-group">
                                <label>Offense</label>
                                <input type="text" name="minor" id="editMinor" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update Minor Rule</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
  
<?php include('C:\xampp\htdocs\Prefect\inc\footer.php'); ?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).on('click', '.editBtn', function() {
    $('#editMinorId').val($(this).data('minorid'));
    $('#editMinor').val($(this).data('minor'));
    $('#editModal').modal('show');
});
</script>
<script src="assets/js/main.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>