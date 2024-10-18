
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
      <h1>Grave Offences</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Offences</li>
          <li class="breadcrumb-item active">Grave Offences</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="container">
        <h1 class="mt-4">4.1.3 GRAVE OFFENSES</h1>
        <p>These are offenses which are so severe. The proper penalty for which is exclusion or expulsion.</p>
        
        <ul class="list-group">
            <li class="list-group-item">4.1.3.1 Possession, use or sale prohibited drugs or chemicals and hallucinogenic drugs or 
                substances in any form within the school premises, or the possession of any regulated drug without the proper prescription.</li>
            <li class="list-group-item">4.1.3.2 Theft pilferage of school equipment, materials or supplies, extortion, robbery or an attempt thereof and any form of dishonesty.</li>
            <li class="list-group-item">4.1.3.3 Forgery or falsification and/ or alteration of academic or official records or documents of any kind.</li>
            <li class="list-group-item">4.1.3.4 Willful disregard of authority, disrespect, discourtesy and disobedience to any school official, member of faculty. 
                administration or their representative</li>
            <li class="list-group-item">4.1.3.5 Direct assault upon a person of authority or any school official, faculty member non-academic staff
                 or any corsonal of the school community</li>
            <li class="list-group-item">4.1.3.6 Having been convicted of a crime and/or moral turpitude in any court of justice.</li>
            <li class="list-group-item">4.1.3.7 Committing any act punishable under existing law of the land within and outside the campus and violation of 
                the laws of the Commission on Higher Education.</li>
            <li class="list-group-item">4.1.3.8 Tampering/altering such as changing original photos of ID cards, registration cards, and other 
                school forms.</li>
            <li class="list-group-item">4.1.3.9 Allowing other students or individuals to use their school ID for any purpose.</li>
            <li class="list-group-item">4.1.3.10 Using the name and seal of BESTLINK on printed matters such as program, invitation, announcement, tickets, certification,
                 solicitation atc., without permission from school president or her official representatives.</li>
            <li class="list-group-item">4.1.3.11 Exposing/ Destroying the image of the school that hampers its integrity in the different broadcasting network and 
                other social media platforms.</li>
            <li class="list-group-item">4.1.3.12 Posting inappropriate photos, videos or messages (Cyber Crime).</li>
            <li class="list-group-item">4.1.3.13 Bullying, harassing, defaming, or discriminating against fellow students, faculty, 
                administrators, employees or any other person in social media platforms.</li>
            <li class="list-group-item">4.1.3.14 Discussing, ventilating uploading grievances, concerns, or issues in social networking platforms.</li>
            <li class="list-group-item">4.1.3.15 Exploding of firecrackers, pyrotechnics, pillbox bomb, molotov bomb, and others.</li>
            <li class="list-group-item">4.1.3.16 Carrying deadly weapon and/ or dangerous weapon Including Improvised weapon, explosive and incendiaries Inside the campus.</li>
            <li class="list-group-item">4.1.3.17 Unauthorized use, opening and/or reading or browsing of computer program, files and the like.</li>
            <li class="list-group-item">4.1.3.18 Recruitment to fraternities, hazing and other similar act (RA 8049),</li>
            <li class="list-group-item">4.1.3.19 Unauthorized bringing of outsiders inside the classroom laboratory or office that destroys properties and/or distracts classroom instruction.</li>
            <li class="list-group-item">4.1.3.20 Provoking offensive action that leads to violence.</li>
            <li class="list-group-item">4.1.3.21 Holding of rallies, meetings, activities or programs without necessary permit from the school authorities.</li>
            <li class="list-group-item">4.1.3.22 Unauthorized copying of computer programs, files and others.</li>
            <li class="list-group-item">4.1.3.23-Uttering/expressing profane or indecent language.</li>
            <li class="list-group-item">4.1.3.24 Gambling or playing cards and any misdemeanor/ misbehavior within 100 meters away from the school.</li>
            <li class="list-group-item">4.1.3.25 Unauthorized selling of tickets/solicitation.</li>
        </ul>
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