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
      <i class="bi bi-bar-chart"></i><span>Incident Log</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="admin_caselog_add.php">
          <i class="bi bi-circle"></i><span>Add</span>
        </a>
      </li>

      <li>
        <a href="admin_caselog_view.php">
          <i class="bi bi-circle"></i><span>View</span>
        </a>
      </li>

      <li>
        <a href="admin_caselog_manage.php">
          <i class="bi bi-circle"></i><span>Manage</span>
        </a>
      </li>
  </ul>    
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#icon-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-people"></i><span>User Log</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="icon-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="admin_userlog_add.php">
          <i class="bi bi-circle"></i><span>Add</span>
        </a>
      </li>

      <li>
        <a href="admin_userlog_view.php">
          <i class="bi bi-circle"></i><span>View</span>
        </a>
      </li>

      <li>
        <a href="admin_userlog_manage.php">
          <i class="bi bi-circle"></i><span>Manage</span>
        </a>
      </li>
  </ul>    
  </li>



  <li class="nav-item">
    <a class="nav-link " id="logout" href="/logout.php">
      <i class="bi bi-grid"></i>
      <span>SIGN OUT</span>
    </a>
  </li>
</aside>