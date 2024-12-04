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
        $graveId = $_POST['grave'];
        $grave = $_POST['grave'];

        if ($action == 'create') {
            // Fixed INSERT query
            $stmt = $connect->prepare("INSERT INTO bcp_sms3_grave (graveId, grave) VALUES (?, ?)");
            $stmt->bind_param("ss", $graveId, $grave);
            if ($stmt->execute()) {
                echo "<script>alert('Grave rules added successfully!');</script>";
            } else {
                $errors[] = "Error adding grave rule.";
            }
            $stmt->close();
        }

        if ($action == 'update') {
            // Fixed UPDATE query
            $stmt = $connect->prepare("UPDATE bcp_sms3_grave SET grave=? WHERE graveId=?");
            $stmt->bind_param("ss", $grave, $graveId);
            if ($stmt->execute()) {
                echo "<script>alert('rules updated successfully!');</script>";
            } else {
                $errors[] = "Error updating rules.";
            }
            $stmt->close();
        }
    }

    if ($action == 'delete') {
        $graveId = $_POST['graveId'];
        $stmt = $connect->prepare("DELETE FROM bcp_sms3_grave WHERE graveId = ?");
        $stmt->bind_param("s", $graveId);
        if ($stmt->execute()) {
            echo "<script>alert('rules deleted successfully!');</script>";
        } else {
            $errors[] = "Error deleting rules.";
        }
        $stmt->close();
    }
}

$query = "SELECT graveId, grave FROM bcp_sms3_grave";
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
      <h1>Grave Offense</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item active">Rules & Violations</li>
          <li class="breadcrumb-item actxive">Grave Offense</li>
        </ol>
      </nav>
    </div>
  
    <p>4.1.3 Grave Offense</p>
    <p>These are offenses which are so severe. The proper penalty for which is exclusion or expulsion.</p>

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
        <td>{$row['grave']}</td>
        <td>
            <button id='offenseedit' class='btn btn-warning btn-sm editBtn' 
                data-grave='{$row['grave']}'>
                Edit
            </button>
            <form method='POST' style='display:inline-block;' onsubmit='return confirm(\"Are you sure you want to delete this?\");'>
                <input type='hidden' name='graveId' value='{$row['graveId']}'>
                <input type='hidden' name='action' value='delete'>
                <button type='submit' class='btn btn-danger btn-sm' id='offensedelete'>Delete</button>
            </form>
        </td>
      </tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>No accounts found</td></tr>";
}
?>
</tbody>
</table>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal" id="addrule">Add Grave Rule</button>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Grave Rule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="create">
                    <div class="form-group">
                        <label id="label">Rule Code</label>
                        <input type="text" name="grave" id="input" class="form-control" required>
                        <span class="text-danger"><?php echo $graveId; ?></span>
                    </div>
                    <div class="form-group">
                        <label id="label">New Rule Grave</label>
                        <input type="text" name="grave" id="input" class="form-control" required>
                        <span class="text-danger"><?php echo $grave; ?></span>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Grave Rules</button>
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
                    <h5 class="modal-title" id="ModalLabel">Edit Rules</h5>
                    <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <div class="form-group">
                        <label>Offense</label>
                        <input type="text" name="grave" id="editgrave" class="form-control" required>
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
        $('#editgraveId').val($(this).data('graveId'));
        $('#editgrave').val($(this).data('grave'));
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