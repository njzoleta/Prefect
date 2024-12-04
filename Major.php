<?php
  session_start();
  include('connect.php');
  include('checklog.php');
  check_login();

$majorId = $major = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'create' || $action == 'update') {
        $majorId = $_POST['major'];
        $major = $_POST['major'];

        if ($action == 'create') {
            // Fixed INSERT query
            $stmt = $connect->prepare("INSERT INTO bcp_sms3_major (majorId, major) VALUES (?, ?)");
            $stmt->bind_param("ss", $majorId, $major);
            if ($stmt->execute()) {
                echo "<script>alert('Minor rules added successfully!');</script>";
            } else {
                $errors[] = "Error adding major rule.";
            }
            $stmt->close();
        }

        if ($action == 'update') {
            // Fixed UPDATE query
            $stmt = $connect->prepare("UPDATE bcp_sms3_major SET major=? WHERE majorId=?");
            $stmt->bind_param("ss", $major, $majorId);
            if ($stmt->execute()) {
                echo "<script>alert('Account updated successfully!');</script>";
            } else {
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
            $errors[] = "Error deleting account.";
        }
        $stmt->close();
    }
}

$query = "SELECT majorId, major FROM bcp_sms3_major";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">

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
      <h1>Major Offense</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item active">Rules & Violations</li>
          <li class="breadcrumb-item actxive">Major Offense</li>
        </ol>
      </nav>
    </div>
  
    <p>4.1.2 Major OFFENSE</p>
    <p>Those that immediately call for a meeting with the parents. Temporary holding of a student while awaiting for 
    the arrival of his parent or guardian may be imposed without any prior warning.</p>

    <div class="container mt-5">
            <div class="text-bottom mb-2">


                <div class="position-relative">
                <table class="table table-bordered ">
                    <thead class="thead-dark">
                    <tr>
                        <th>OFFENSE</th>
                        <th>Action</th>
                      
                    </tr>
                    </thead>
                    </div>  


                    <tbody>
                    <?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <td>{$row['major']}</td>
        <td>
            <button id='offenseedit' class='btn btn-warning btn-sm editBtn' 
                data-major='{$row['major']}' >
                Edit
            </button>
            <form method='POST' style='display:inline-block;' onsubmit='return confirm(\"Are you sure you want to delete this?\");'>
                <input type='hidden' name='majorId'  value='{$row['majorId']}'>
                <input type='hidden' name='action' value='delete'>
                <button type='submit' class='btn btn-danger btn-sm' id='offensedelete'>Delete</button>
            </form>
        </td>
      </tr>";

    }
} else {
    echo "<tr><td colspan='6' class='text-center'>No Rules found</td></tr>";
}
?>
</tbody>
</table>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal" id="addrule">Add Major Rule </button>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Major Rule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                    <span aria-hidden="true">&times;</span>

                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="create">
                    <div class="form-group">
                        <label id="label">Rule Code</label>
                        <input type="text" name="minor" class="form-control" id="input" required>
                        <span class="text-danger"><?php echo $majorId; ?></span>
                    </div>
                    <div class="form-group">
                        <label id="label">New Major Rule</label>
                        <input type="text" name="minor" class="form-control" id="input" required>
                        <span class="text-danger"><?php echo $major; ?></span>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" >Add major Rule</button>
                    
                    
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
                    <h5 class="modal-title" id="ModalLabel">Edit Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <div class="form-group">
                        <label id="label">Offense</label>
                        <input type="text" name="major" id="editmajor" id="input" class="form-control" required>
                    </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="update">Update Account</button>
                    
                </div>
            </form>
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
    // jQuery script to show the edit modal
    $(document).on('click', '.editBtn', function() {
        $('#editmajorId').val($(this).data('majorId'));
        $('#editmajor').val($(this).data('major'));
        $('#editModal').modal('show');
    });
  </script>
<script>
    document.getElementById("add-report-btn").addEventListener("click", function() {
        document.getElementById("report-modal").style.display = "block";
    });
    
    
    var modals = document.getElementsByClassName("modal");
    for (var i = 0; i < modals.length; i++) {
        var modal = modals[i];
        var closeBtn = modal.getElementsByClassName("close")[0];
        modal.addEventListener("click", function(event) {
            if (event.target == this || event.target == closeBtn) {
                this.style.display = "none";
            }
        });
    }
        </script>



  <!-- Javascript -->
  <script src="assets/js/main.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>