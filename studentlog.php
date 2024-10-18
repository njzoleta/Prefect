<?php
include('connect.php'); 
if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}

$Account_Id = $Name = $Year = $Course = $Password = $User_Type = '';
$Account_Iderr = $Nameerr = $Yearerr = $Courseerr = $Passworderr = $User_typeerr = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'create' || $action == 'update') {
        $Account_Id = $_POST['Account_Id'];
        $Name = $_POST['Name'];
        $Year = $_POST['Year'];
        $Course = $_POST['Course'];
        $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
        $User_Type = $_POST['User_Type'];

        if ($action == 'create') {
            $stmt = $connect->prepare("INSERT INTO bcp_sms3_register (Account_Id, Name, Year, Course, Password, User_Type) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $Account_Id, $Name, $Year, $Course, $Password, $User_Type);
            if ($stmt->execute()) {
                echo "<script>alert('Account added successfully!');</script>";
            } else {
                $errors[] = "Error adding account.";
            }
            $stmt->close();
        }

        if ($action == 'update') {
            $stmt = $connect->prepare("UPDATE bcp_sms3_register SET Name=?, Year=?, Course=?, Password=?, User_Type=? WHERE Account_Id=?");
            $stmt->bind_param("ssssss", $Name, $Year, $Course, $Password, $User_Type, $Account_Id);
            if ($stmt->execute()) {
                echo "<script>alert('Account updated successfully!');</script>";
            } else {
                $errors[] = "Error updating account.";
            }
            $stmt->close();
        }
    }

    if ($action == 'delete') {
        $Account_Id = $_POST['Account_Id'];
        $stmt = $connect->prepare("DELETE FROM bcp_sms3_register WHERE Account_Id = ?");
        $stmt->bind_param("s", $Account_Id);
        if ($stmt->execute()) {
            echo "<script>alert('Account deleted successfully!');</script>";
        } else {
            $errors[] = "Error deleting account.";
        }
        $stmt->close();
    }
}

$query = "SELECT Account_Id, Name, Year, Course, Password, User_Type FROM bcp_sms3_register";
$result = mysqli_query($connect, $query);

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard</title>

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

</head>
<body>


  <header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <img src="logo.png" alt="">
          <span class="d-none d-lg-block">Prefect Department</span>
      </a>

    <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
    <li class="nav-item d-block d-lg-none">
    <a class="nav-link nav-icon search-bar-toggle " href="#">
    <i class="bi bi-search"></i>
    </a>

    <li class="nav-item dropdown">
    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
    <i class="bi bi-bell"></i>
    <span class="badge bg-primary badge-number">4</span>
    </a>

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">

            <li class="dropdown-header">
              You have 4 new notifications
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>

    <li>
    <hr class="dropdown-divider">
    </li>
    </ul>
    </li>
    </nav> 
        </div>
    </div>
  </header>

  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Student Information</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="Seniorhigh.php">
              <i class="bi bi-circle"></i><span>SENIOR HIGHSCHOOL</span>
            </a>
          </li>
          <li>
            <a href="College.php">
              <i class="bi bi-circle"></i><span>COLLEGE</span>
            </a>
          </li>
 
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Offences</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="Minor.php">
              <i class="bi bi-circle"></i><span>MINOR OFFENCES</span>
            </a>
          </li>
          <li>
            <a href="Major.php">
              <i class="bi bi-circle"></i><span>MAJOR OFFENCES</span>
            </a>
          </li>
          <li>
            <a href="Grave.php">
              <i class="bi bi-circle"></i><span>GRAVE OFFENCES</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Prefect information</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="conduct.php">
              <i class="bi bi-circle"></i><span>Student Conduct</span>
            </a>
          </li>
          <li>
            <a href="faq.php">
              <i class="bi bi-circle"></i><span>FAQ</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Reports/History</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="incidentlog.php">
              <i class="bi bi-circle"></i><span>Incident History Log</span>
            </a>
          </li>
          <li>
            <a href="report.php">
              <i class="bi bi-circle"></i><span>Case report</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="studentlog.php">
          <i class="bi bi-grid"></i>
          <span>Register</span>
        </a>
      </li>

   
      <li class="nav-item">
        <a class="nav-link " id="logout" href="/logout.php">
          <i class="bi bi-grid"></i>
          <span>SIGN OUT</span>
        </a>
      </li>
  </aside>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>
    
        <div class="container mt-5">
            <div class="text-bottom mb-2">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Add Student</button>
            </div>


                <div class="position-relative">
                <table class="table table-bordered table-striped position-absolute top-30 start-50">
                    <thead class="thead-dark">
                    <tr>
                        <th>Account Id</th>
                        <th>Full Name</th>
                        <th>Year</th>
                        <th>Course</th>
                        <th>User Type</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    </div>  


                    <tbody>
                    <?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['Account_Id']}</td>
                <td>{$row['Name']}</td>
                <td>{$row['Year']}</td>
                <td>{$row['Course']}</td>
                <td>{$row['User_Type']}</td>
                <td>
                    <button class='btn btn-warning btn-sm editBtn' 
                        data-accountid='{$row['Account_Id']}' 
                        data-fullname='{$row['Name']}'
                        data-year='{$row['Year']}'
                        data-course='{$row['Course']}'
                        data-password='{$row['Password']}'
                        data-usertype='{$row['User_Type']}'>Edit</button>
                    <form method='POST' style='display:inline-block;' onsubmit='return confirm(\"Are you sure?\");'>
                        <input type='hidden' name='Account_Id' value='{$row['Account_Id']}'>
                        <input type='hidden' name='action' value='delete'>
                        <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
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

<!-- Add Account Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="create">
                    <div class="form-group">
                        <label>Account ID</label>
                        <input type="number" name="Account_Id" class="form-control" required>
                        <span class="text-danger"><?php echo $Account_Iderr; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="Name" class="form-control" required>
                        <span class="text-danger"><?php echo $Nameerr; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Year</label>
                        <input type="text" name="Year" class="form-control" required>
                        <span class="text-danger"><?php echo $Yearerr; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Course</label>
                        <input type="text" name="Course" class="form-control" required>
                        <span class="text-danger"><?php echo $Courseerr; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="Password" class="form-control" required>
                        <span class="text-danger"><?php echo $Passworderr; ?></span>
                    </div>
                    <div class="form-group">
                        <label>User Type</label>
                        <select name="User_Type" class="form-control">
                            <option value="1">Admin</option>
                            <option value="2">Student</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Account</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Account Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <div class="form-group">
                        <label>Account ID</label>
                        <input type="text" name="Account_Id" id="editAccountId" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="Name" id="editName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Year</label>
                        <input type="text" name="Year" id="editYear" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Course</label>
                        <input type="text" name="Course" id="editCourse" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="Password" id="editPassword" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>User Type</label>
                        <select name="User_Type" id="editUser_Type" class="form-control">
                            <option value="1">Admin</option>
                            <option value="2">Student</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Account</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Error Messages Display -->
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
    // Populate the Edit Modal with the selected student's data
    $(document).on('click', '.editBtn', function() {
        $('#editAccount_Id').val($(this).data('Account_Id'));
        $('#editName').val($(this).data('Fullname'));
        $('#editYear').val($(this).data('Year'));
        $('#editCourse').val($(this).data('Course'));
        $('#editPassword').val($(this).data('Password'))
        $('#editUser_Type').val($(this).data('Usertype'));
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
