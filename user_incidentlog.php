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

<!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="/logo.png" alt="">
          <span class="d-none d-lg-block">Prefect Department</span>
      </a>

    <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
<!-- End Logo -->


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
  <!-- End Notification Icon -->

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
<!-- End Header -->


<!-- ======= Sidebar ======= -->  
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="user.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Offences</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="user_minor.php">
              <i class="bi bi-circle"></i><span>MINOR OFFENCES</span>
            </a>
          </li>
          <li>
            <a href="user_major.php">
              <i class="bi bi-circle"></i><span>MAJOR OFFENCES</span>
            </a>
          </li>
          <li>
            <a href="user_grave.php">
              <i class="bi bi-circle"></i><span>GRAVE OFFENCES</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Prefect information</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="user_conduct.php">
              <i class="bi bi-circle"></i><span>Student Conduct</span>
            </a>
          </li>
          <li>
            <a href="user_faq.php">
              <i class="bi bi-circle"></i><span>FAQ</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Reports/History</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="user_incidentlog.php">
              <i class="bi bi-circle"></i><span>Incident History Log</span>
            </a>
          </li>
          <li>
            <a href="user_report.php">
              <i class="bi bi-circle"></i><span>Case report</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->


      <li class="nav-item">
        <a class="nav-link " id="logout" href="/logout.php">
          <i class="bi bi-grid"></i>
          <span>SIGN OUT</span>
        </a>
      </li>
  </aside>
<!-- End Sidebar-->


  <main id="main" class="main">
    <div class="pagetitle">
      <h1 class="dashboard">Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>    
<!-- End Page Title -->
       
<!-- Recent case -->
 <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Incident <span>| Today</span></h5>
                    <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Student #</th>
                        <th scope="col">Name</th>
                        <th scope="col">Grade/Year</th>
                        <th scope="col">Course</th>
                        <th scope="col">Section</th>
                        <th scope="col">Offences</th>
                        <th scope="col">Status</th>
          </tr>
          </thead>

          <tbody>
          <tr>
                        <th scope="row"><a href="#">#2457</a></th>
                        <td>Kyla B. Ta-ay</td>
                        <td><a href="#" class="text-primary">3rd year</a></td>
                        <td>BSEDUC</td>
                        <td>310</td>
                        <td>Vandalism</td>
                        <td><span class="badge bg-danger">Rejected</span></td>
          </tr>

          <tr>
                        <th scope="row"><a href="#">24211</a></th>
                        <td>Janine Besmonte</td>
                        <td><a href="#" class="text-primary">3rd Year</a></td>
                        <td>BSEDUC</td>
                        <td>3104</td>
                        <td>Public Display of Affection</td>
                        <td><span class="badge bg-success">Approved</span></td>
          </tr>

          <tr>
                        <th scope="row"><a href="#">#2457</a></th>
                        <td>Vejay Cayanan</td>
                        <td><a href="#" class="text-primary">2rt year</a></td>
                        <td>BSIT</td>
                        <td>2101</td>
                        <td>Recruitment to fraternities</td>
                        <td><span class="badge bg-danger">Rejected</span></td>
          </tr>

          <tr>
                        <th scope="row"><a href="#">#2457</a></th>
                        <td>Kenneth Perdigon</td>
                        <td><a href="#" class="text-primary">2nd year</a></td>
                        <td>BSIT</td>
                        <td>4101</td>
                        <td>Pornographic</td>
                        <td><span class="badge bg-danger">Rejected</span></td>
          </tr>

          <tr>
                  <th scope="row"><a href="#">#2555</a></th>
                  <td>Jaybie Sosmena</td>
                  <td><a href="#" class="text-primary">Grade 11</a></td>
                        <td>ICT</td>
                        <td>1102</td>
                        <td>Bully</td>
                        <td><span class="badge bg-success">Approved</span></td>
          </tr>
          </tbody>
          </table>
          </div>
          </div>
          </div>

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