<?php
session_start();
  include('connect.php');
  include('checklog.php');
  check_login();
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

<!-- ======= Header ======= -->
<?php include('C:\xampp\htdocs\Prefect\inc\header.php'); ?>
<!-- End Header -->


<!-- ======= Sidebar ======= -->  
<?php include('C:\xampp\htdocs\Prefect\inc\sidebar.php'); ?>
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
            <table class="table table-borderless datatable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Student number</th>
                  <th>Name</th>
                  <th>Year</th>
                  <th>Course</th>
                  <th>Section</th>
                  <th>Offence</th>
                  <th>Incident Date</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                    $ret = "SELECT * FROM bcp_sms_log WHERE Status IN ('Incident Approved', 'Incident Pending', 'Incident Ongoing')";
                    $stmt = $connect->prepare($ret);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    $cnt = 1;

                    while($row = $res->fetch_object()) {
                  ?>
                    <tr>
                      <td><?php echo $cnt++; ?></td>
                      <td><?php echo $row->Studentnumber; ?></td>
                      <td><?php echo $row->nameid; ?></td>
                      <td><?php echo $row->yearid; ?></td>
                      <td><?php echo $row->courseid; ?></td>
                      <td><?php echo $row->sectionid; ?></td>
                      <td><?php echo $row->offencesid; ?></td>
                      <td><?php echo $row->dateofincident; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
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
<?php include('C:\xampp\htdocs\Prefect\inc\footer.php'); ?>
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