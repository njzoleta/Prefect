<?php
session_start();
include('connect.php');
include('checklog.php');
check_login();

$graveId = $grave = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'create' || $action == 'update') {
        $graveId = $_POST['graveId'] ?? '';
        $grave = $_POST['grave'] ?? '';

        if ($action == 'create') {
            $stmt = $connect->prepare("INSERT INTO bcp_sms3_grave (graveId, grave) VALUES (?, ?)");
            $stmt->bind_param("ss", $graveId, $grave);
            if ($stmt->execute()) {
                echo "<script>alert('grave rules added successfully!');</script>";
            } else {
                error_log("Database error: " . $stmt->error);
                $errors[] = "Error adding grave rule.";
            }
            $stmt->close();
        }

        if ($action == 'update') {
            $stmt = $connect->prepare("UPDATE bcp_sms3_grave SET grave=? WHERE graveId=?");
            $stmt->bind_param("ss", $grave, $graveId);
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
        $graveId = $_POST['graveId'];
        $stmt = $connect->prepare("DELETE FROM bcp_sms3_grave WHERE graveId = ?");
        $stmt->bind_param("s", $graveId);
        if ($stmt->execute()) {
            echo "<script>alert('Account deleted successfully!');</script>";
        } else {
            error_log("Database error: " . $stmt->error);
            $errors[] = "Error deleting account.";
        }
        $stmt->close();
    }
}

$query = "SELECT graveId, grave FROM bcp_sms3_grave";
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
      <h1>grave Offense</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item">Rules & Violations</li>
          <li class="breadcrumb-item active">grave Offense</li>
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
                        <td>{$row['grave']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm editBtn' 
                                data-graveid='{$row['graveId']}' 
                                data-grave='{$row['grave']}'>
                                Edit
                            </button>
                            <form method='POST' style='display:inline-block;' onsubmit='return confirm(\"Are you sure you want to delete this?\");'>
                                <input type='hidden' name='graveId' value ='{$row['graveId']}'>
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
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Add grave Rule</button>

        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Add grave Rule</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="action" value="create">
                            <div class="form-group">
                                <label>New grave Rule</label>
                                <input type="text" name="grave" class="form-control" required>
                                <span class="text-danger"><?php echo $grave; ?></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add grave Rule</button>
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
                            <h5 class="modal-title" id="editModalLabel">Edit grave Rule</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="graveId" id="editgraveId">
                            <div class="form-group">
                                <label>Offense</label>
                                <input type="text" name="grave" id="editgrave" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update grave Rule</button>
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
    $('#editgraveId').val($(this).data('graveid'));
    $('#editgrave').val($(this).data('grave'));
    $('#editModal').modal('show');
});
</script>
<script src="assets/js/main.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>