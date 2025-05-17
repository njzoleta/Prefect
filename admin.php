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





// Updated function to fetch counts per course and severity
function getSeverityCountsByCourse($connect, $category, $period) {
    $counts = [];

    $dateCondition = "";
    if ($period === 'week') {
        $dateCondition = "AND incident_date >= CURDATE() - INTERVAL 7 DAY";
    } elseif ($period === 'month') {
        $dateCondition = "AND incident_date >= CURDATE() - INTERVAL 1 MONTH";
    } elseif ($period === 'semester') {
        $dateCondition = "AND incident_date >= CURDATE() - INTERVAL 6 MONTH";
    }

$sql = "SELECT bcp_sms_log.courseid, bcp_sms_log.severityid, bcp_sms_log.Nameid, COUNT(*) as count 
            FROM bcp_sms_log 
            WHERE category = ? $dateCondition 
            GROUP BY courseid, severityid, Nameid";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        // Initialize course if not already set
        if (!isset($counts[$row['courseid']])) {
            $counts[$row['courseid']] = ['minor' => 0, 'major' => 0, 'grave' => 0, 'names' => []];
        }
        // Add the count for the severity
        $counts[$row['courseid']][strtolower($row['severityid'])] = $row['count'];
        // Add the Nameid to the names array
        $counts[$row['courseid']]['names'][] = $row['Nameid'];
    }
    return $counts;
}

// Fetch data for Senior High and College
$seniorHighWeekCounts = getSeverityCountsByCourse($connect, 'Senior High', 'week');
$collegeWeekCounts = getSeverityCountsByCourse($connect, 'College', 'week');

$seniorHighMonthCounts = getSeverityCountsByCourse($connect, 'Senior High', 'month');
$collegeMonthCounts = getSeverityCountsByCourse($connect, 'College', 'month');

$seniorHighSemesterCounts = getSeverityCountsByCourse($connect, 'Senior High', 'semester');
$collegeSemesterCounts = getSeverityCountsByCourse($connect, 'College', 'semester');

// Convert data to JSON for JavaScript
$seniorHighWeekJson = json_encode($seniorHighWeekCounts);
$collegeWeekJson = json_encode($collegeWeekCounts);

$seniorHighMonthJson = json_encode($seniorHighMonthCounts);
$collegeMonthJson = json_encode($collegeMonthCounts);

$seniorHighSemesterJson = json_encode($seniorHighSemesterCounts);
$collegeSemesterJson = json_encode($collegeSemesterCounts);



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="./assets/css/admin.css" rel="stylesheet">

</head>
<body>

<?php include('../Prefect/inc/header.php'); ?>
<?php include('../Prefect/inc/adminsidebar.php'); ?>
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

<main>
<div id="reportContent">
    <!-- Senior High School Section -->
    <section class="section dashboard py-5">
        <h1 class="fs-1 fw-bold text-center text-primary mb-5">Senior High School</h1>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="row">
                        <?php
                        $timePeriods = ['week', 'month', 'semester'];
                        foreach ($timePeriods as $period) { ?>
                            <div class="col-xxl-4 col-md-4 mb-4">
                                <div class="card info-card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Incidents <span>| <?= ucfirst($period) ?></span></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="icon">
                                                <i class="bi bi-exclamation-circle text-warning fs-3" aria-hidden="true"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6 class="mb-0"><?= $seniorHighCounts[$period]; ?></h6>
                                                <span class="text-<?= $seniorHighChange[$period] == 'Increase' ? 'success' : 'danger'; ?> small pt-1 fw-bold">
                                                    <?= $seniorHighPercentageChange[$period]; ?>
                                                </span>
                                                <span class="text-muted small pt-2 ps-1">
                                                    <?= $seniorHighChange[$period] == 'Increase' ? 'increase' : 'decrease'; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Senior High Line Graphs and Report Cards -->
                        <?php foreach ($timePeriods as $period) { ?>
                            <div class="col-md-12 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h3 class="card-title text-center">Report / <?= ucfirst($period) ?></h3>
                                        <div id="seniorHigh<?= ucfirst($period) ?>Chart" class="chart-placeholder"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Table for Senior High -->
                            <div class="col-md-12 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h3 class="card-title text-center">Incident Severity Report / <?= ucfirst($period) ?></h3>

                                   
<!-- Table for Senior High -->

// Table for Senior High
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Course</th>
            <th scope="col">Minor</th>
            <th scope="col">Major</th>
            <th scope="col">Grave</th>
            <th scope="col">Student Names</th> 
        </tr>
    </thead>
    <tbody>
        <?php
$seniorHighPeriodData = ${"seniorHigh" . ucfirst($period) . "Counts"}; // Dynamically use the period data
foreach ($seniorHighPeriodData as $course => $severities) {
    echo "<tr>";
    echo "<td>{$course}</td>";
    echo "<td>{$severities['minor']}</td>";
    echo "<td>{$severities['major']}</td>";
    echo "<td>{$severities['grave']}</td>";
    // Directly display names in the table cell
    $Nameid = implode(", ", $severities['names']); // Ensure you are using the correct key
    echo "<td>{$Nameid}</td>"; 
    echo "</tr>";
}
        ?>
    </tbody>
</table>



                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="reportContent">
    <!-- College Section -->
    <section class="section dashboard py-5">
        <h1 class="fs-1 fw-bold text-center text-primary mb-5">College</h1>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="row">
                        <?php
                        $timePeriods = ['week', 'month', 'semester'];
                        foreach ($timePeriods as $period) { ?>
                            <div class="col-xxl-4 col-md-4 mb-4">
                                <div class="card info-card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Incidents <span>| <?= ucfirst($period) ?></span></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="icon">
                                                <i class="bi bi-exclamation-circle text-danger fs-3" aria-hidden="true"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6 class="mb-0"><?= $collegeCounts[$period]; ?></h6>
                                                <span class="text-<?= $collegeChange[$period] == 'Increase' ? 'success' : 'danger'; ?> small pt-1 fw-bold">
                                                    <?= $collegePercentageChange[$period]; ?>
                                                </span>
                                                <span class="text-muted small pt-2 ps-1">
                                                    <?= $collegeChange[$period] == 'Increase' ? 'increase' : 'decrease'; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- College Line Graphs and Report Cards -->
                        <?php foreach ($timePeriods as $period) { ?>
                            <div class="col-md-12 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h3 class="card-title text-center">Report / <?= ucfirst($period) ?></h3>
                                        <div id="college<?= ucfirst($period) ?>Chart" class="chart-placeholder"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Table for College -->
                            <div class="col-md-12 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h3 class="card-title text-center">Incident Severity Report / <?= ucfirst($period) ?></h3>

                                        <!-- Table for College -->
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Course</th>
                                                    <th scope="col">Minor</th>
                                                    <th scope="col">Major</th>
                                                    <th scope="col">Grave</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Loop through the College data for the given period
                                                $collegePeriodData = ${"college" . ucfirst($period) . "Counts"}; // Dynamically use the period data
                                                foreach ($collegePeriodData as $course => $severities) {
                                                    echo "<tr>";
                                                    echo "<td>{$course}</td>";
                                                    echo "<td>{$severities['minor']}</td>";
                                                    echo "<td>{$severities['major']}</td>";
                                                    echo "<td>{$severities['grave']}</td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

                <button onclick="downloadPDF()">Download Report</button>             
               </div>
                
        </div>
    </section>
</main>


  <!-- ======= Footer ======= -->
  <?php include('../Prefect/inc/footer.php'); ?>
  <!-- End Footer -->  


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
   function downloadPDF() {
    const { jsPDF } = window.jspdf;

    // Capture the content from the 'reportContent' div
    html2canvas(document.getElementById('reportContent'), {
        useCORS: true, // Ensure that CORS is enabled for external resources like images
        allowTaint: true, // Allow tainted content
    }).then(function (canvas) {
        const doc = new jsPDF();

        // Convert canvas to image data
        const imgData = canvas.toDataURL('image/png');

        // Add image to the PDF. You can adjust the size and position as needed
        doc.addImage(imgData, 'PNG', 10, 10, 150, 200); // (img, format, x, y, width, height)

        // Save the PDF with the desired filename
        doc.save('report.pdf');
    }).catch(function (error) {
        console.log("Error capturing content:", error);
    });
}

</script>


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
document.querySelectorAll("td[names]").forEach(function (cell) {
    cell.addEventListener("mouseover", function () {

        console.log("Student Name: " + cell.getAttribute("Nameid"));
    });
});



document.addEventListener("DOMContentLoaded", () => {
    // Data from PHP
    const seniorHighWeekData = <?php echo $seniorHighWeekJson; ?>;
    const collegeWeekData = <?php echo $collegeWeekJson; ?>;

    const seniorHighMonthData = <?php echo $seniorHighMonthJson; ?>;
    const collegeMonthData = <?php echo $collegeMonthJson; ?>;

    const seniorHighSemesterData = <?php echo $seniorHighSemesterJson; ?>;
    const collegeSemesterData = <?php echo $collegeSemesterJson; ?>;

    // Function to create a line chart
    function createLineChart(elementId, data, title) {
        const categories = Object.keys(data); // Get all the courses (keys)
        const minorData = categories.map(course => data[course].minor || 0);
        const majorData = categories.map(course => data[course].major || 0);
        const graveData = categories.map(course => data[course].grave || 0);

        new ApexCharts(document.querySelector(`#${elementId}`), {
            series: [
                {
                    name: 'Minor',
                    data: minorData,
                },
                {
                    name: 'Major',
                    data: majorData,
                },
                {
                    name: 'Grave',
                    data: graveData,
                },
            ],
            chart: {
                type: 'line',
                height: 350,
            },
            title: {
                text: title,
                align: 'center',
                margin: 10,
                style: {
                    fontSize: '20px',
                    fontWeight: 'bold',
                },
            },
            xaxis: {
                categories: categories,  // Display course names on the X-axis
                title: {
                    text: 'Courses', // Title for the X-axis
                },
                labels: {
                    rotate: -45, // Rotate labels to fit long course names
                    style: {
                        colors: '#000',
                        fontSize: '12px',
                        fontWeight: 'bold',
                    },
                },
            },
            yaxis: {
                title: {
                    text: 'Number of Incidents', // Title for the Y-axis
                },
            },
            colors: ['#2E86C1', '#F39C12', '#C0392B'], // Minor, Major, Grave colors
            stroke: {
                width: 2,
                curve: 'smooth',
            },
            markers: {
                size: 5,
            },
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: (val) => val,  // Display the actual count value on hover
                },
            },
        }).render();
    }

    // Create line charts for Senior High
    createLineChart("seniorHighWeekChart", seniorHighWeekData, "Senior High - Week");
    createLineChart("seniorHighMonthChart", seniorHighMonthData, "Senior High - Month");
    createLineChart("seniorHighSemesterChart", seniorHighSemesterData, "Senior High - Semester");

    // Create line charts for College
    createLineChart("collegeWeekChart", collegeWeekData, "College - Week");
    createLineChart("collegeMonthChart", collegeMonthData, "College - Month");
    createLineChart("collegeSemesterChart", collegeSemesterData, "College - Semester");
});


// Download full dashboard as PDF
document.getElementById("downloadPDF").addEventListener("click", function () {
    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF('p', 'mm', 'a4');

    html2canvas(document.body).then((canvas) => {
        const imgData = canvas.toDataURL("image/png");
        pdf.addImage(imgData, "PNG", 10, 10, 190, 0);
        pdf.save("dashboard_report.pdf");
    });
});
  </script>
</body>
</html>