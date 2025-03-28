<?php
session_start();
include('connect.php'); // Ensure this file establishes a connection to your database
include('checklog.php'); // Ensure this file checks if the user is logged in
check_login();

function getIncidentCounts($connect, $category) {
    $counts = [];

    // Weekly
    $sql = "SELECT COUNT(*) as count FROM bcp_sms_log WHERE incident_date >= CURDATE() - INTERVAL 7 DAY AND category = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $counts['week'] = $result->fetch_assoc()['count'];

    // Monthly
    $sql = "SELECT COUNT(*) as count FROM bcp_sms_log WHERE incident_date >= CURDATE() - INTERVAL 1 MONTH AND category = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $counts['month'] = $result->fetch_assoc()['count'];

    // Semester
    $sql = "SELECT COUNT(*) as count FROM bcp_sms_log WHERE incident_date >= CURDATE() - INTERVAL 6 MONTH AND category = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $counts['semester'] = $result->fetch_assoc()['count'];

    return $counts;
}

// Fetch data for both categories
$seniorHighCounts = getIncidentCounts($connect, 'Senior High');
$collegeCounts = getIncidentCounts($connect, 'College');

// Function to calculate change
function calculateChange($currentCount, $previousCount) {
    if ($currentCount > $previousCount) {
        return 'Increase';
    } elseif ($currentCount < $previousCount) {
        return 'Decrease';
    } else {
        return 'No Change';
    }
}

// Assuming you have previous counts stored (for demonstration purposes)
$previousSeniorHighCounts = ['week' => 5, 'month' => 10, 'semester' => 25]; // Example previous counts
$previousCollegeCounts = ['week' => 5, 'month' => 10, 'semester' => 50]; // Example previous counts

// Calculate changes
$seniorHighChange = [
    'week' => calculateChange($seniorHighCounts['week'], $previousSeniorHighCounts['week']),
    'month' => calculateChange($seniorHighCounts['month'], $previousSeniorHighCounts['month']),
    'semester' => calculateChange($seniorHighCounts['semester'], $previousSeniorHighCounts['semester']),
];

// Function to calculate percentage change
function calculatePercentageChange($currentCount, $previousCount) {
    if ($previousCount == 0) {
        return $currentCount > 0 ? '100%' : '0%';
    }
    return round((($currentCount - $previousCount) / $previousCount) * 100, 2) . '%';
}

// Calculate percentage changes
$seniorHighPercentageChange = [
    'week' => calculatePercentageChange($seniorHighCounts['week'], $previousSeniorHighCounts['week']),
    'month' => calculatePercentageChange($seniorHighCounts['month'], $previousSeniorHighCounts['month']),
    'semester' => calculatePercentageChange($seniorHighCounts['semester'], $previousSeniorHighCounts['semester']),
];

$collegeChange = [
    'week' => calculateChange($collegeCounts['week'], $previousCollegeCounts['week']),
    'month' => calculateChange($collegeCounts['month'], $previousCollegeCounts['month']),
    'semester' => calculateChange($collegeCounts['semester'], $previousCollegeCounts['semester']),
];

// Calculate percentage changes for college
$collegePercentageChange = [
    'week' => calculatePercentageChange($collegeCounts['week'], $previousCollegeCounts['week']),
    'month' => calculatePercentageChange($collegeCounts['month'], $previousCollegeCounts['month']),
    'semester' => calculatePercentageChange($collegeCounts['semester'], $previousCollegeCounts['semester']),
];

// Fetch incident data for a specific period
function getIncidentData($connect, $period, $category) {
    $dateCondition = '';
    switch ($period) {
        case 'week':
            $dateCondition = "WHERE incident_date >= CURDATE() - INTERVAL 7 DAY";
            break;
        case 'month':
            $dateCondition = "WHERE incident_date >= CURDATE() - INTERVAL 1 MONTH";
            break;
        case 'semester':
            $dateCondition = "WHERE incident_date >= CURDATE() - INTERVAL 6 MONTH";
            break;
    }

    // Prepare the SQL query
    $sql = "SELECT COUNT(*) as count, courseid FROM bcp_sms_log $dateCondition AND category = ? GROUP BY courseid";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

// Fetch data for different periods and categories
$seniorHighWeekData = getIncidentData($connect, 'week', 'Senior High');
$collegeWeekData = getIncidentData($connect, 'week', 'College');

$seniorHighMonthData = getIncidentData($connect, 'month', 'Senior High');
$collegeMonthData = getIncidentData($connect, 'month', 'College');

$seniorHighSemesterData = getIncidentData($connect, 'semester', 'Senior High');
$collegeSemesterData = getIncidentData($connect, 'semester', 'College');

// Convert data to JSON format for JavaScript
$seniorHighWeekDataJson = json_encode($seniorHighWeekData);
$collegeWeekDataJson = json_encode($collegeWeekData);

$seniorHighMonthDataJson = json_encode($seniorHighMonthData);
$collegeMonthDataJson = json_encode($collegeMonthData);

$seniorHighSemesterDataJson = json_encode($seniorHighSemesterData);
$collegeSemesterDataJson = json_encode($collegeSemesterData);





function getseverityidCounts($connect, $category, $period) {
  $counts = ['minor' => 0, 'major' => 0, 'grave' => 0];

  $dateCondition = "";
  if ($period === 'week') {
      $dateCondition = "AND incident_date >= CURDATE() - INTERVAL 7 DAY";
  } elseif ($period === 'month') {
      $dateCondition = "AND incident_date >= CURDATE() - INTERVAL 1 MONTH";
  } elseif ($period === 'semester') {
      $dateCondition = "AND incident_date >= CURDATE() - INTERVAL 6 MONTH";
  }

  $sql = "SELECT severityid, COUNT(*) as count FROM bcp_sms_log WHERE category = ? $dateCondition GROUP BY severityid";
  $stmt = $connect->prepare($sql);
  $stmt->bind_param("s", $category);
  $stmt->execute();
  $result = $stmt->get_result();

  while ($row = $result->fetch_assoc()) {
      $counts[strtolower($row['severityid'])] = $row['count'];
  }

  return $counts;
}

// Fetch severityid data for Senior High and College
$seniorHighWeek = getseverityidCounts($connect, 'Senior High', 'week');
$seniorHighMonth = getseverityidCounts($connect, 'Senior High', 'month');
$seniorHighSemester = getseverityidCounts($connect, 'Senior High', 'semester');

$collegeWeek = getseverityidCounts($connect, 'College', 'week');
$collegeMonth = getseverityidCounts($connect, 'College', 'month');
$collegeSemester = getseverityidCounts($connect, 'College', 'semester');

// Convert data to JSON for JavaScript
$seniorHighWeekJson = json_encode(array_values($seniorHighWeek));
$seniorHighMonthJson = json_encode(array_values($seniorHighMonth));
$seniorHighSemesterJson = json_encode(array_values($seniorHighSemester));

$collegeWeekJson = json_encode(array_values($collegeWeek));
$collegeMonthJson = json_encode(array_values($collegeMonth));
$collegeSemesterJson = json_encode(array_values($collegeSemester));
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard</title>

  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="./assets/css/admin.css" rel="stylesheet">

</head>
<body>

<?php include('C:\xampp\htdocs\Prefect\inc\header.php'); ?>
<?php include('C:\xampp\htdocs\Prefect\inc\adminsidebar.php'); ?>

<main id="main" class="main">
    <div class="pagetitle">
      <h1 class="dashboard">Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>    

<section class="section dashboard py-5">
  <h1 class="fs-1 fw-bold text-center title mb-5 text-primary">Senior High School</h1>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="row">

        <div class="row">
          <!-- Incidents Card for Week -->
          <div class="col-xxl-4 col-md-4 mb-4">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Incidents <span>| Week</span></h5>
                <div class="d-flex align-items-center">
                  <div class=" d-flex align-items-center justify-content-center">
                    <i class=""></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $seniorHighCounts['week']; ?></h6>
                    <span class="text-<?php echo $seniorHighChange['week'] == 'Increase' ? 'success' : 'danger'; ?> small pt-1 fw-bold">
                      <?php echo $seniorHighPercentageChange['week']; ?>
                    </span>
                    <span class="text-muted small pt-2 ps-1">
                      <?php echo $seniorHighChange['week'] == 'Increase' ? 'increase' : 'decrease'; ?>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Incidents Card for Month -->
          <div class="col-xxl-4 col-md-4 mb-4">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Incidents <span>| Month</span></h5>
                <div class="d-flex align-items-center">
                  <div class=" d-flex align-items-center justify-content-center">
                    <i class=""></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $seniorHighCounts['month']; ?></h6>
                    <span class="text-<?php echo $seniorHighChange['month'] == 'Increase' ? 'success' : 'danger'; ?> small pt-1 fw-bold">
                      <?php echo $seniorHighPercentageChange['month']; ?>
                    </span>
                    <span class="text-muted small pt-2 ps-1">
                      <?php echo $seniorHighChange['month'] == 'Increase' ? 'increase' : 'decrease'; ?>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Incidents Card for Semester -->
          <div class="col-xxl-4 col-md-4 mb-4">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Incidents <span>| Semester</span></h5>
                <div class="d-flex align-items-center">
                  <div class=" d-flex align-items-center justify-content-center">
                    <i class=""></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $seniorHighCounts['semester']; ?></h6>
                    <span class="text-<?php echo $seniorHighChange['semester'] == 'Increase' ? 'success' : 'danger'; ?> small pt-1 fw-bold">
                      <?php echo $seniorHighPercentageChange['semester']; ?>
                    </span>
                    <span class="text-muted small pt-2 ps-1">
                      <?php echo $seniorHighChange['semester'] == 'Increase' ? 'increase' : 'decrease'; ?>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

        
          <!-- Weekly Report Card -->
          <div class="col-md-12 mb-12">
            <div class="card shadow-sm">
              <div class="card-body">
                <h3 class="card-title text-center">Report / Week</h3>
                <div id="seniorHighWeekChart" class="chart-placeholder"></div>
              </div>
            </div>
          </div>

          <!-- Monthly Report Card -->
          <div class="col-md-12 mb-12">
            <div class="card shadow-sm">
              <div class="card-body">
                <h3 class="card-title text-center">Report / Month</h3>
                <div id="seniorHighMonthChart" class="chart-placeholder"></div>
              </div>
            </div>
          </div>

          <!-- Semester Report Card -->
          <div class="col-md-12 mb-12">
            <div class="card shadow-sm">
              <div class="card-body">
                <h3 class="card-title text-center">Report / Semester</h3>
                <div id="seniorHighSemesterChart" class="chart-placeholder"></div>
              </div>
            </div>
          </div>
        </div>

        <h1>Senior High School severityid Distribution</h1>
<h2>Week</h2><div id="seniorHighWeekChart"></div>
<h2>Month</h2><div id="seniorHighMonthChart"></div>
<h2>Semester</h2><div id="seniorHighSemesterChart"></div>

      </div>
    </div>
  </div>
</section>

<section class="section dashboard py-5">
  <h1 class="fs-1 fw-bold text-center text-primary mb-5">College</h1>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="row">

        <div class="row">
          <!-- Incidents Card for Week -->
          <div class="col-xxl-4 col-md-4 mb-4">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Incidents <span>| Week</span></h5>
                <div class="d-flex align-items-center">
                  <div class=" d-flex align-items-center justify-content-center">
                    <i class=""></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $collegeCounts['week']; ?></h6>
                    <span class="text-<?php echo $collegeChange['week'] == 'Increase' ? 'success' : 'danger'; ?> small pt-1 fw-bold">
                      <?php echo $collegePercentageChange['week']; ?>
                    </span>
                    <span class="text-muted small pt-2 ps-1">
                      <?php echo $collegeChange['week'] == 'Increase' ? 'increase' : 'decrease'; ?>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Incidents Card for Month -->
          <div class="col-xxl-4 col-md-4 mb-4">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Incidents <span>| Month</span></h5>
                <div class="d-flex align-items-center">
                  <div class=" d-flex align-items-center justify-content-center">
                    <i class=""></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $collegeCounts['month']; ?></h6>
                    <span class="text-<?php echo $collegeChange['month'] == 'Increase' ? 'success' : 'danger'; ?> small pt-1 fw-bold">
                      <?php echo $collegePercentageChange['month']; ?>
                    </span>
                    <span class="text-muted small pt-2 ps-1">
                      <?php echo $collegeChange['month'] == 'Increase' ? 'increase' : 'decrease'; ?>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Incidents Card for Semester -->
          <div class="col-xxl-4 col-md-4 mb-4">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Incidents <span>| Semester</span></h5>
                <div class="d-flex align-items-center">
                  <div class="d-flex align-items-center justify-content-center">
                    <i class=""></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $collegeCounts['semester']; ?></h6>
                    <span class="text-<?php echo $collegeChange['semester'] == 'Increase' ? 'success' : 'danger'; ?> small pt-1 fw-bold">
                      <?php echo $collegePercentageChange['semester']; ?>
                    </span>
                    <span class="text-muted small pt-2 ps-1">
                      <?php echo $collegeChange['semester'] == 'Increase' ? 'increase' : 'decrease'; ?>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          <!-- Weekly Report Card -->
          <div class="col-md-12 mb-12">
            <div class="card shadow-sm">
              <div class="card-body">
                <h3 class="card-title text-center">Report / Week</h3>
                <div id="collegeWeekChart" class="chart-placeholder"></div>
              </div>
            </div>
          </div>

          <!-- Monthly Report Card -->
          <div class="col-md-12 mb-12">
            <div class="card shadow-sm">
              <div class="card-body">
                <h3 class="card-title text-center">Report / Month</h3>
                <div id="collegeMonthChart" class="chart-placeholder"></div>
              </div>
            </div>
          </div>

          <!-- Semester Report Card -->
          <div class="col-md-12 mb-12">
            <div class="card shadow-sm">
              <div class="card-body">
                <h3 class="card-title text-center">Report / Semester</h3>
                <div id="collegeSemesterChart" class="chart-placeholder"></div>
              </div>
            </div>
          </div>
        </div>


        <h1>College severityid Distribution</h1>
<h2>Week</h2><div id="collegeWeekChart"></div>
<h2>Month</h2><div id="collegeMonthChart"></div>
<h2>Semester</h2><div id="collegeSemesterChart"></div>

 
      </div>
    </div>
  </div>
</section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include('C:\xampp\htdocs\Prefect\inc\footer.php'); ?>
  <!-- End Footer -->  


  <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>

  <script>
  document.addEventListener("DOMContentLoaded", () => {
      const seniorHighWeekData = <?php echo $seniorHighWeekDataJson; ?>;
      const collegeWeekData = <?php echo $collegeWeekDataJson; ?>;

      const seniorHighMonthData = <?php echo $seniorHighMonthDataJson; ?>;
      const collegeMonthData = <?php echo $collegeMonthDataJson; ?>;

      const seniorHighSemesterData = <?php echo $seniorHighSemesterDataJson; ?>;
      const collegeSemesterData = <?php echo $collegeSemesterDataJson; ?>;

      // Define color mapping for courses
      const colorMapping = {
          'STEM': '#FF5733',
          'ICT': '#33FF57',
          'HE': '#3357FF',
          'GAS': '#F1C40F',
          'ABM': '#8E44AD',
          'BSIT': '#7D3C98',
          'BSTM': '#2980B9',
          'BSOA': '#D35400',
          'BSCRIM': '#C0392B',
          'BSEDUC': '#27AE60',
          'BSHM': '#F39C12',
          'BSENTREP': '#8E44AD',
          'BSBA': '#2C3E50',
          'BSCpE': '#E67E22',
          'BEEd': '#3498DB',
          'BSP': '#9B59B6'
      };

      const createChart = (elementId, data) => {
          const categories = data.map(item => item.courseid);
          const seriesData = data.map(item => parseInt(item.count));
          const colors = categories.map(course => colorMapping[course] || '#000000'); // Default to black if course not found

          new ApexCharts(document.querySelector(`#${elementId}`), {
              series: [{
                  name: 'Inc idents',
                  data: seriesData
              }],
              chart: {
                  type: 'bar',
                  height: 200
              },
              xaxis: {
                  categories: categories
              },
              colors: colors // Set the colors for the series
          }).render();
      };

      createChart('seniorHighWeekChart', seniorHighWeekData);
      createChart('collegeWeekChart', collegeWeekData);

      createChart('seniorHighMonthChart', seniorHighMonthData);
      createChart('collegeMonthChart', collegeMonthData);

      createChart('seniorHighSemesterChart', seniorHighSemesterData);
      createChart('collegeSemesterChart', collegeSemesterData);
  });


  document.addEventListener("DOMContentLoaded", () => {
    // Data from PHP
    const seniorHighWeekData = <?php echo $seniorHighWeekJson; ?>;
    const seniorHighMonthData = <?php echo $seniorHighMonthJson; ?>;
    const seniorHighSemesterData = <?php echo $seniorHighSemesterJson; ?>;

    const collegeWeekData = <?php echo $collegeWeekJson; ?>;
    const collegeMonthData = <?php echo $collegeMonthJson; ?>;
    const collegeSemesterData = <?php echo $collegeSemesterJson; ?>;

    const categories = ["Minor", "Major", "Grave"];

    // Function to create a pie chart
    function createPieChart(elementId, data) {
        new ApexCharts(document.querySelector(`#${elementId}`), {
            series: data,
            chart: {
                type: 'pie',
                height: 350
            },
            labels: categories,
            colors: ["#2E86C1", "#F39C12", "#C0392B"]
        }).render();
    }

    // Create charts for Senior High
    createPieChart("seniorHighWeekChart", seniorHighWeekData);
    createPieChart("seniorHighMonthChart", seniorHighMonthData);
    createPieChart("seniorHighSemesterChart", seniorHighSemesterData);

    // Create charts for College
    createPieChart("collegeWeekChart", collegeWeekData);
    createPieChart("collegeMonthChart", collegeMonthData);
    createPieChart("collegeSemesterChart", collegeSemesterData);
});
  </script>
</body>
</html>