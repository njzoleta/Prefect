
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
      <h1>Student Conduct</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Prefect Information</li>
          <li class="breadcrumb-item active">Student Code of Conduct of agreement</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="container">
        <h1 class="mt-4">STUDENT CODE OF CONDUCT AGREEMENT</h1>
        <p>As a student/scholarship grantee of this institution, I commit to abide by the school's policies, procedures, 
            rule and regulations as set forth in the STUDENT HANDBOOK, specifically the following statements below:
        </p>
        
        <ul class="list-group">
            <li class="list-group-item">1. I shall live up to the school's vision, mission, institution goals, core values, and advocacies.</li>
            <li class="list-group-item">2. I shall MAINTAIN GOOD BEHAVIOR befitting of a student in and off campus.</li>
            <li class="list-group-item">3. I shall be respectful in my interaction with school administrators, teachers, other school personnel, parents and visitors.</li>
            <li class="list-group-item">4. I shall refrain from saying inappropriate, disrespectful, and foul words in dealing with the people around me.</li>
            <li class="list-group-item">5. I shall refrain from speaking negatively about other people, Including other schools, in any way.</li>
            <li class="list-group-item">6. I shall report to proper school authority cases or incidents that violate the stipulations above.</li>
            <li class="list-group-item">7. I shall consider myself responsible for the content i posted ONLINE</li>
            <li class="list-group-item">7.1 I shall refrain from sending inappropriate or malicious images, videos, and messages to classmates, school mates, friends, teachers, and school in general.
                school forms.</li>
            <li class="list-group-item">7.2. I shall not engage in ONLINE BEHAVIOR that might be interpreted as dishonest, indecent, immature, rude, disrespectful, 
                discriminatory, violent, arrogant, Immoral, or aggressive.</li>
            <li class="list-group-item">7.3. I shall refrain from engaging in arguments and inflammatory debates whether ONLINE OR IN PERSON</li>
            <li class="list-group-item">7.4 I shall not UPLOAD OR SHARE Inappropriate images, videos or messages.</li>
            <li class="list-group-item">7.5 I shall not express concems/complaints towards the institutions. administrators, teachers, other employees, parents/guardians, and students using social media platforms. Instead,
                 I shall confront concerns accordingly and in person, seeking assistance from my teacher/s or administrators when necessary</li>
        </ul>

        <p>Always remember, a person who places A PHOTO, VIDEO MESSAGE on the INTERNET is deemed to have intended to forsake and renounce all privacy rights to such imagery or text.</p>
        <p>Any violation of the agreement above will be subjected to appropriate disciplinary action as stipulated in the STUDENT HANDBOOK.</p>
        <p>If found guilty, the scholarship will be deemed null and void and shall be forced to pay the school's required TUITION FEE</p>
    </div>
    

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Prefect Department</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
    <a href="">Prefect Department</a>
    </div>
  </footer><!-- End Footer -->






  <!-- Javascript -->
  <script src="assets/js/main.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>