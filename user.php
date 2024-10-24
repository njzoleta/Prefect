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
          <li class="breadcrumb-item"><a href="user.php">Home</a></li>
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

          <section class="section dashboard">

              <h1 class="fs-1 fw-bold text-center">SENIOR HIGHSCHOOL</h1>

          <div class="row">
<!-- Left side columns -->
          <div class="col-lg-8">
          <div class="row">

          <div class="col-xxl-4 col-md-6">
          <div class="card info-card Student-card">
          <div class="card-body">

                          <h5 class="card-title">PREFECT <span>| TODAY</span></h5>

          <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
          <i class="bi bi-people"></i>
          
          </div>
          <div class="ps-3">

                          <h6>145</h6>
                          <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
        
          </div>
          </div>
          </div>
          </div>
          </div>
<!-- End Sales Card -->
        

<!-- Revenue Card -->
        <div class="col-xxl-4 col-md-6">
        <div class="card info-card student-card">
        <div class="card-body">

                          <h5 class="card-title">PREFECT <span>| MONTHS</span></h5>
        
        <div class="d-flex align-items-center">
        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
        <i class="bi bi-people"></i>

        </div>
        <div class="ps-3">
                              <h6>560</h6>
                              <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>
        
        </div>
        </div>
        </div>
        </div>
        </div>
<!-- End Revenue Card -->
        
<!-- Customers Card -->
        <div class="col-xxl-4 col-xl-12">
        <div class="card info-card customers-card">
        <div class="card-body">
          
                          <h5 class="card-title">PREFECT <span>| SEMESTER</span></h5>
        
       <div class="d-flex align-items-center">
       <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
       <i class="bi bi-people"></i>

        </div>
        <div class="ps-3">

                              <h6>1244</h6>
                              <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>
        
        </div>
        </div>
        </div>
        </div>
        </div>
<!-- End Customers Card -->
        
<!-- Reports -->
       <div class="col-12">
       <div class="card">
       <div class="card-body">

                          <h5 class="card-title">Reports Cases<span>/ Semester</span></h5>
        
<!-- Line Chart -->
      <div id="reportsChart"></div>
      <script>

                            document.addEventListener("DOMContentLoaded", () => {
                              new ApexCharts(document.querySelector("#reportsChart"), {
                                series: [{
                                  data: [31,23,25,50,30,60],
                                }],
                                
                                chart: {
                                  height: 700,
                                  type: 'bar',
                                  toolbar: {
                                    show: false
                                  },
                                },
                                markers: {
                                  size: 2
                                },
                                colors: [ '#2eca6a',],
                                fill: {
                                  type: "gradient",
                                  gradient: {
                                    shadeIntensity: 1,
                                    opacityFrom: 0.5,
                                    opacityTo: 1.5,
                                    stops: [0, 500, 5000]
                                  }
                                },
                                dataLabels: {
                                  enabled: false
                                },
                                stroke: {
                                  curve: 'smooth',
                                  width: 10
                                },
                                xaxis: {
                                  type: 'category',
                                  categories: ["ICT","STEM","ABM","HE","HUMSS","GAS",]
                                }
                              }).render();
                            });
      </script>
<!-- End Line Chart -->
        
      </div>
      </div>
      </div>
<!-- End Reports -->
      </div>
       </div>
<!-- End Left side columns -->
        

<!-- Right side columns -->
       <div class="col-lg-4">
        
<!-- Website Traffic -->
      <div class="card">
      <div class="card-body pb-0">

                      <h5 class="card-title">Cases This <span>| Month</span></h5>
                      <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
       <script>

                        document.addEventListener("DOMContentLoaded", () => {
                          echarts.init(document.querySelector("#trafficChart")).setOption({
                            tooltip: {
                              trigger: 'item'
                            },
                            legend: {
                              top: '5%',
                              left: 'center'
                            },
                            series: [{
                              name: 'CASES',
                              type: 'pie',
                              radius: ['40%', '70%'],
                              avoidLabelOverlap: false,
                              label: {
                                show: false,
                                position: 'center'
                              },
                              emphasis: {
                                label: {
                                  show: true,
                                  fontSize: '18',
                                  fontWeight: 'bold'
                                }
                              },
                              labelLine: {
                                show: false
                              },
                              data: [{
                                  value: 1048,
                                  name: 'ICT'
                                },
                                {
                                  value: 735,
                                  name: 'STEM'
                                },
                                {
                                  value: 580,
                                  name: 'GAS'
                                },
                                {
                                  value: 484,
                                  name: 'HE'
                                },
                                
                                {
                                  value: 300,
                                  name: 'ABM'
                                },
                                {
                                  value: 300,
                                  name: 'HUMSS'
                                },
                                
                                
                              ]
                            }]
                          });
                        });
      </script>
      </div>
      </div>
<!-- End Website Traffic -->

<!-- Website Traffic -->
       <div class="card">
        <div class="card-body pb-0">

                                        <h5 class="card-title">Cases This <span>| Week</span></h5>

        <div id="casechartsenior" style="min-height: 400px;" class="echart"></div>
        <script>

                                          document.addEventListener("DOMContentLoaded", () => {
                                            echarts.init(document.querySelector("#casechartsenior")).setOption({
                                              tooltip: {
                                                trigger: 'item'
                                              },
                                              legend: {
                                                top: '5%',
                                                left: 'center'
                                              },
                                              series: [{
                                                name: 'CASES',
                                                type: 'pie',
                                                radius: ['40%', '70%'],
                                                avoidLabelOverlap: false,
                                                label: {
                                                  show: false,
                                                  position: 'center'
                                                },
                                                emphasis: {
                                                  label: {
                                                    show: true,
                                                    fontSize: '18',
                                                    fontWeight: 'bold'
                                                  }
                                                },
                                                labelLine: {
                                                  show: false
                                                },
                                                data: [{
                                                  value: 1048,
                                                name: 'ICT'
                                              },
                                              {
                                                value: 735,
                                                name: 'STEM'
                                              },
                                              {
                                                value: 580,
                                                name: 'GAS'
                                              },
                                              {
                                                value: 484,
                                                name: 'HE'
                                              },
                                              
                                              {
                                                value: 300,
                                                name: 'ABM'
                                              },
                                              {
                                                value: 300,
                                                name: 'HUMSS'
                                              },

                                                ]
                                              }]
                                            });
                                          });
        </script>
        </div>
        </div>
<!-- End Website Traffic -->
 
        </div>

<!-- End sidebar recent posts-->

        </div>
        </div>
        
<!-- End Right side columns -->
        </div>
        </section>

        <section class="section dashboard">

              <h1 class="fs-1 fw-bold text-center">COLLEGE</h1>

        <div class="row">
        
<!-- Left side columns -->
        <div class="col-lg-8">
        <div class="row">
        
<!-- Sales Card -->

        <div class="col-xxl-4 col-md-6">
        <div class="card info-card sales-card">
        <div class="card-body">
          
                          <h5 class="card-title">Sales <span>| Today</span></h5>
        
        <div class="d-flex align-items-center">
        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
        <i class="bi bi-cart"></i>

        </div>
        <div class="ps-3">

                          <h6>145</h6>
                          <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
        
        </div>
        </div>
        </div>
        </div>
        </div>
<!-- End Sales Card -->
        
<!-- Revenue Card -->
      <div class="col-xxl-4 col-md-6">
      <div class="card info-card revenue-card">
      <div class="card-body">

                        <h5 class="card-title">Revenue <span>| This Month</span></h5>
        
      <div class="d-flex align-items-center">
      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
      <i class="bi bi-currency-dollar"></i>
      </div>
      <div class="ps-3">

                              <h6>$3,264</h6>
                              <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>
        
      </div>
      </div>
      </div>
      </div>
      </div>
<!-- End Revenue Card -->
        
<!-- Customers Card -->
      <div class="col-xxl-4 col-xl-12">
      <div class="card info-card customers-card">
      <div class="card-body">

                        <h5 class="card-title">Customers <span>| This Year</span></h5>
        
      <div class="d-flex align-items-center">
      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
      <i class="bi bi-people"></i>
      </div>
      <div class="ps-3">

                        <h6>1244</h6>
                        <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>
        
      </div>
      </div>
      </div>
      </div>
      </div>
<!-- End Customers Card -->
        
<!-- Reports -->
                    <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Reports Cases<span>/ Semester</span></h5>
        
                          <!-- Line Chart -->
                          <div id="Semestercollege"></div>
        
                          <script>
                            document.addEventListener("DOMContentLoaded", () => {
                              new ApexCharts(document.querySelector("#Semestercollege"), {
                                series: [{
                                  data: [31,23,25,50,60,31,23,25,50,30,60,102,]
                                }],
                                
                                chart: {
                                  height: 700,
                                  type: 'bar',
                                  toolbar: {
                                    show: false
                                  },
                                },
                                markers: {
                                  size: 2
                                },
                                colors: [ '#2eca6a',],
                                fill: {
                                  type: "gradient",
                                  gradient: {
                                    shadeIntensity: 1,
                                    opacityFrom: 0.5,
                                    opacityTo: 1.5,
                                    stops: [0, 500, 5000]
                                  }
                                },
                                dataLabels: {
                                  enabled: false
                                },
                                stroke: {
                                  curve: 'smooth',
                                  width: 10
                                },
                                xaxis: {
                                  type: 'category',
                                  categories: ["BSIT","BSTM","BSCIM","BSHM","BSOA","BSP",
                                  "BSBA","BEEd,BPEd & BTLed","BSEDUC","BSCpE","BSENTREP","BSAIS",]
                                }
                              }).render();
                            });
                          </script>
                          <!-- End Line Chart -->
        
                        </div>
        
                      </div>
                    </div><!-- End Reports -->
         
                  </div>
                </div><!-- End Left side columns -->
        

                <!-- Right side columns -->
                <div class="col-lg-4">
        
                  <!-- Website Traffic -->
                  <div class="card">
                    <div class="card-body pb-0">
                      <h5 class="card-title">Cases This <span>| Week</span></h5>
                      <div id="weekcasescollege" style="min-height: 400px;" class="echart"></div>
                      <script>
                        document.addEventListener("DOMContentLoaded", () => {
                          echarts.init(document.querySelector("#weekcasescollege")).setOption({
                            tooltip: {
                              trigger: 'item'
                            },
                            legend: {
                              left: 'center'
                            },
                            series: [{
                              name: 'CASES',
                              type: 'pie',
                              radius: ['30%', '50%'],
                              avoidLabelOverlap: false,
                              label: {
                                show: false,
                                position: 'center'
                              },
                              emphasis: {
                                label: {
                                  show: true,
                                  fontSize: '18',
                                  fontWeight: 'bold'
                                }
                              },
                              labelLine: {
                                show: false
                              },
                              data: [{
                                  value: 30,
                                  name: 'BSIT'
                                },
                                {
                                  value: 50,
                                  name: 'BSTM'
                                },
                                {
                                  value: 580,
                                  name: 'BSCRIM'
                                },
                                {
                                  value: 484,
                                  name: 'BSEDUC'
                                },
                                {
                                  value: 120,
                                  name: 'BSHM'
                                },
                                {
                                  value: 484,
                                  name: 'BSENTREP'
                                },
                                {
                                  value: 40,
                                  name: 'BSOA'
                                },
                                {
                                  value: 150,
                                  name: 'BSBA'
                                },
                                {
                                  value: 484,
                                  name: 'BSP'
                                },
                                {
                                  value: 580,
                                  name: 'BEEd,BPEd & BTLed'
                                },
                                {
                                  value: 370,
                                  name: 'BSCpE'
                                },
                                {
                                  value: 484,
                                  name: 'BSAIS'
                                },
                                
                              ]
                            }]
                          });
                        });
                      </script>
        
                    </div>
                  </div>
<!--  Week case-->

<!-- Month case -->
                                    <div class="card">
                                      <div class="card-body pb-0">
                                        <h5 class="card-title">Cases This <span>| Month</span></h5>
                                        <div id="monthcasecollege" style="min-height: 400px;" class="echart"></div>
                                        <script>
                                          document.addEventListener("DOMContentLoaded", () => {
                                            echarts.init(document.querySelector("#monthcasecollege")).setOption({
                                              tooltip: {
                                                trigger: 'item'
                                              },
                                              legend: {
                                                left: 'center'
                                              },
                                              series: [{
                                                name: 'Access From',
                                                type: 'pie',
                                                radius: ['30%', '50%'],
                                                avoidLabelOverlap: false,
                                                label: {
                                                  show: false,
                                                  position: 'center'
                                                },
                                                emphasis: {
                                                  label: {
                                                    show: true,
                                                    fontSize: '18',
                                                    fontWeight: 'bold'
                                                  }
                                                },
                                                labelLine: {
                                                  show: false
                                                },
                                                data: [{
                                                  value: 30,
                                                  name: 'BSIT'
                                                },
                                                {
                                                  value: 50,
                                                  name: 'BSTM'
                                                },
                                                {
                                                  value: 580,
                                                  name: 'BSCRIM'
                                                },
                                                {
                                                  value: 484,
                                                  name: 'BSEDUC'
                                                },
                                                {
                                                  value: 120,
                                                  name: 'BSHM'
                                                },
                                                {
                                                  value: 484,
                                                  name: 'BSENTREP'
                                                },
                                                {
                                                  value: 40,
                                                  name: 'BSOA'
                                                },
                                                {
                                                  value: 150,
                                                  name: 'BSBA'
                                                },
                                                {
                                                  value: 484,
                                                  name: 'BSP'
                                                },
                                                {
                                                  value: 580,
                                                  name: 'BEEd,BPEd & BTLed'
                                                },
                                                {
                                                  value: 370,
                                                  name: 'BSCpE'
                                                },
                                                {
                                                  value: 484,
                                                  name: 'BSAIS'
                                                },

                                                ]
                                              }]
                                            });
                                          });
                                        </script>
                          
                                      </div>
                                    </div><!-- End Website Traffic -->
                      </div><!-- End sidebar recent posts-->
                    </div>
                </div><!-- End Right side columns -->
              </div>
            </section>
        
          </main><!-- End #main -->
   

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