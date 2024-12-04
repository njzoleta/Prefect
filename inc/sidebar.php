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
      <i class="bi bi-journal-text"></i><span>Rules & Violations</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="user_minor.php">
          <i class="bi bi-circle"></i><span>MINOR OFFENSE</span>
        </a>
      </li>
      <li>
        <a href="user_major.php">
          <i class="bi bi-circle"></i><span>MAJOR OFFENSE</span>
        </a>
      </li>
      <li>
        <a href="user_grave.php">
          <i class="bi bi-circle"></i><span>GRAVE OFFENSE</span>
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
      <i class="bi bi-bar-chart"></i><span>Incident Log</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
    <li>
        <a href="user_caselog_add.php">
          <i class="bi bi-circle"></i><span>ADD</span>
        </a>
      </li>
      <li>
        <a href="user_caselog_view.php">
          <i class="bi bi-circle"></i><span>VIEW</span>
        </a>
      </li>
    </ul>
  </li><!-- End Charts Nav -->


  <li class="nav-item">
    <a class="nav-link " id="logout" href="logout.php">
      <i class="bi bi-grid"></i>
      <span>LOG OUT</span>
    </a>
  </li>
</aside>