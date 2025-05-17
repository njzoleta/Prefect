<?php
session_start();
include('connect.php');
include('checklog.php');
check_login();

$AccountId = $Username = $password = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action == 'create') {
        $AccountId = trim($_POST['AccountId'] ?? '');
        $Username = trim($_POST['Username'] ?? '');
        $rawPassword = $_POST['password'] ?? '';

        // Basic validation
        if (empty($AccountId) || empty($Username) || empty($rawPassword)) {
            $errors[] = "All fields are required.";
        } else {
            $password = password_hash($rawPassword, PASSWORD_DEFAULT);

            $stmt = $connect->prepare("INSERT INTO bcp_sms3_admin (AccountId, Username, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $AccountId, $Username, $password);

            if ($stmt->execute()) {
                echo "<script>alert('Admin account added successfully!');</script>";
                // Clear values after successful insert
                $AccountId = $Username = $password = '';
            } else {
                error_log("Database error: " . $stmt->error);
                $errors[] = "Error adding admin account: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}

$query = "SELECT AccountId, Username FROM bcp_sms3_admin";
$result = mysqli_query($connect, $query);
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

<?php include('../Prefect/inc/header.php'); ?>
<?php include('../Prefect/inc/adminsidebar.php'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="dashboard">Admin Log</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                <li class="breadcrumb-item active">Admin Log</li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
        </nav>
    </div>

    <div class="card-body">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <div><?php echo htmlspecialchars($error); ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" id="form">
            <input type="hidden" name="action" value="create">

            <div class="form-group mb-3">
                <label for="AccountId">Account ID</label>
                <input type="text" required class="form-control" id="AccountId" name="AccountId" value="<?php echo htmlspecialchars($AccountId); ?>">
            </div>

            <div class="form-group mb-3">
                <label for="Username">Username</label>
                <input type="text" required class="form-control" id="Username" name="Username" value="<?php echo htmlspecialchars($Username); ?>">
            </div>

            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" required class="form-control" id="password" name="password" value="">
            </div>

            <button type="button" class="btn btn-success" onclick="showConfirmationDialog()">Add Admin</button>
        </form>
    </div>
</main>

<?php include('../Prefect/inc/footer.php'); ?>

<!-- Bootstrap & Script dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

<!-- Modal -->
<div id="confirmationModal" class="modal fade" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Admin Creation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to add this admin account?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Yes</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showConfirmationDialog() {
        var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        confirmationModal.show();
    }

    function submitForm() {
        document.getElementById('form').submit();
    }
</script>

</body>
</html>
