<?php
session_start();
include('connect.php');
include('checklog.php');
check_login();

$majorId =$majorcode= $major = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'create' || $action == 'update') {
        $majorId = $_POST['majorId'] ?? '';
        $majorcode = $_POST['majorcode'] ?? '';
        $major = $_POST['major'] ?? '';

        if ($action == 'create') {
            $stmt = $connect->prepare("INSERT INTO bcp_sms3_major (majorId, majorcode,major) VALUES (?,?, ?)");
            $stmt->bind_param("sss", $majorId,$majorcode, $major);
            if ($stmt->execute()) {
                echo "<script>alert('major rules added successfully!');</script>";
            } else {
                error_log("Database error: " . $stmt->error);
                $errors[] = "Error adding major rule.";
            }
            $stmt->close();
        }

        if ($action == 'update') {
            $stmt = $connect->prepare("UPDATE bcp_sms3_major SET major=? WHERE majorId=?");
            $stmt->bind_param("ss", $major, $majorId);
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
        $majorId = $_POST['majorId'];
        $stmt = $connect->prepare("DELETE FROM bcp_sms3_major WHERE majorId = ?");
        $stmt->bind_param("s", $majorId);
        if ($stmt->execute()) {
            echo "<script>alert('Account deleted successfully!');</script>";
        } else {
            error_log("Database error: " . $stmt->error);
            $errors[] = "Error deleting account.";
        }
        $stmt->close();
    }
}

$query = "SELECT majorId, majorcode,major FROM bcp_sms3_major";
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
      <h1>major Offense</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item">Rules & Violations</li>
          <li class="breadcrumb-item active">major Offense</li>
        </ol>
      </nav>
    </div>

    <div class="container mt-5">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>CODE</th>
                    <th>OFFENSE</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                        <td>{$row['majorcode']}</td>
                        <td>{$row['major']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm editBtn' 
                                data-majorid='{$row['majorId']}' 
                                data-major='{$row['major']}'>
                                Edit
                            </button>
                            <form method='POST' style='display:inline-block;' onsubmit='return confirm(\"Are you sure you want to delete this?\");'>
                                <input type='hidden' name='majorId' value ='{$row['majorId']}'>
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
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Add major Rule</button>

        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Add major Rule</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="action" value="create">
                            <div class="form-group">
                                <label>New major Rule</label>
                                <input type="text" name="major" class="form-control" required>
                                <span class="text-danger"><?php echo $major; ?></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add major Rule</button>
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
                            <h5 class="modal-title" id="editModalLabel">Edit major Rule</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="majorId" id="editmajorId">
                            <div class="form-group">
                                <label>Offense</label>
                                <input type="text" name="major" id="editmajor" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update major Rule</button>
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
    $('#editmajorId').val($(this).data('majorid'));
    $('#editmajor').val($(this).data('major'));
    $('#editModal').modal('show');
});
</script>
<script src="assets/js/main.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>