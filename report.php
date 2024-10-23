
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

      <a href="admin.php" class="logo d-flex align-items-center">
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
        <a class="nav-link " href="admin.php">
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
      <h1 class="dashboard">Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
        <li class="breadcrumb-item active">Report / History</li>
        <li class="breadcrumb-item active">Case Report</li>
        </ol>
      </nav>
    </div>    
<div class="container">
    <h1 class="page-title">Report Form</h1>
    
    <form id="report-form" class="bg-transparent">
        <!-- Full Name Input -->
        <div class="mb-3">
            <label for="fullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname" required placeholder="Enter your full name">
        </div>

        <!-- Year/Grade Input -->
        <div class="mb-3">
            <label for="year-grade" class="form-label">Year/Grade</label>
            <select class="form-select" id="year-grade" name="year-grade">
                <option value="Grade 11">Grade 11</option>
                <option value="Grade 12">Grade 12</option>
                <option value="1st College">1st College</option>
                <option value="2nd College">2nd College</option>
                <option value="3rd College">3rd College</option>
                <option value="4th College">4th College</option>
            </select>
        </div>

        <!-- Course Input -->
        <div class="mb-3">
            <label for="course" class="form-label">Course</label>
            <select class="form-select" id="course" name="course">
                <option value="ICT">ICT</option>
                  <option value="STEM">STEM</option>
                    <option value="ABM">ABM</option>
                      <option value="GAS">GAS</option>
                        <option value="HE">HE</option>
                          <option value="HUMSS">HUMSS</option>

                <option value="BSP">BSP</option>
                  <option value="BSIT">BSIT</option>
                    <option value="BSTM">BSTM</option>
                      <option value="BSHM">BSHM</option>
                        <option value="BSOA">BSOA</option>
                          <option value="BSCRIM">BSCRIM</option>
                            <option value="BSBA">BSBA</option>
                          <option value="BLIS">BLIS</option>
                        <option value="BEEd,BPEd & BTLed">BEEd,BPEd & BTLED</option>
                      <option value="BSEDUC">BSEDUC</option>
                    <option value="BSCpE">BSCpE</option>
                  <option value="BSENTREP">BSENTREP</option>
                <option value="BSAIS">BSEDUC</option>
                
                <!-- Add other course options here -->
            </select>
        </div>

        <!-- Section Input -->
        <div class="mb-3">
            <label for="section" class="form-label">Section</label>
            <input class="form-control" type="number" id="section" name="section" required placeholder="Enter your section">
        </div> 

        <!-- Organization Input -->
        <div class="mb-3">
            <label for="organization" class="form-label">Organization Affiliated & Position</label>
            <input type="text" class="form-control" id="organization" name="organization" required placeholder="Enter your organization and position">
        </div>

        <!-- Severity Level Input -->
        <div class="mb-3">
            <label for="severity-level" class="form-label">Severity Level</label>
            <select id="severity-level" class="form-select" name="severity-level">
                <option value="Minor">Minor Offences</option>
                <option value="Major">Major Offences</option>
                <option value="Grave">Grave Offences</option>
            </select> 
        </div>

        <!-- Offences Input -->
        <div class="mb-3">
            <label for="offences" class="form-label">Offences</label>
            <input class="form-control" type="text" id="offences" name="offences" required placeholder="Describe the offence">
        </div>

        <!-- Evidence Input -->
        <div class="mb-3">
            <label for="evidence" class="form-label">Evidence (Photos/Videos)</label>
            <input type="file" class="form-control" id="evidence" accept="image/*,video/*" multiple required>
            <small class="form-text text-muted">You can upload multiple files.</small>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary" id="report">Submit</button>
    </form>
</div>
</main>


<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Prefect Department</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
    <a href="">Prefect Department</a>
    </div>
  </footer>
<!-- End Footer --> 


<!-- Javascript -->
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