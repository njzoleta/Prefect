<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include('connect.php');

// Check for the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the referral form
    $student_number = $_POST['student_number'];
    $student_name = $_POST['student_name'];
    $course_year = $_POST['course_year'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $reason = $_POST['reason'];
    $referred_to = $_POST['referred_to'];
    $referred_by = $_POST['referred_by'];

    // Check if variables are being received
    if (empty($student_number) || empty($student_name) || empty($course_year) || empty($age) || empty($sex) || empty($reason) || empty($referred_to) || empty($referred_by)) {
        die("Some fields are missing.");
    }

    // Get current timestamp for created_at
    $created_at = date('Y-m-d H:i:s');

    // Debugging: Log POST data
    error_log(print_r($_POST, true));

    // Insert the data into the database (Referral table)
    $stmt = $conn->prepare("INSERT INTO referrals (student_number, student_name, course_year, age, sex, reason, referred_to, referred_by, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error); // Check if statement preparation failed
    }

    // Bind parameters
    $stmt->bind_param("sssssssss", $student_number, $student_name, $course_year, $age, $sex, $reason, $referred_to, $referred_by, $created_at);

    // Execute the query
    if ($stmt->execute()) {
        echo "Referral submitted successfully!";
    } else {
        error_log("Error executing query: " . $stmt->error); // Log query execution error
        echo "Error submitting referral: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    exit();
}

// Display referrals in the inbox (fetching data)
$sql = "SELECT id, student_number, student_name, course_year, reason, status FROM referrals";
$result = $conn->query($sql);

// Fetch and display specific referral details if referral_id is set in the URL
if (isset($_GET['referral_id'])) {
    $referral_id = $_GET['referral_id'];
    $sql_referral = "SELECT * FROM referrals WHERE id = ?";
    $stmt_referral = $conn->prepare($sql_referral);
    $stmt_referral->bind_param("i", $referral_id);
    $stmt_referral->execute();
    $referral_result = $stmt_referral->get_result();
    $referral = $referral_result->fetch_assoc();
    $stmt_referral->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Referral Inbox</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 p-4 border rounded">
        <h3 class="text-center">Referral Inbox</h3>

        <!-- Referral Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Student Number</th>
                    <th>Student Name</th>
                    <th>Course & Year</th>
                    <th>Reason for Referral</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['student_number']; ?></td>
                            <td><a href="guidance.php?referral_id=<?php echo $row['id']; ?>"><?php echo $row['student_name']; ?></a></td>
                            <td><?php echo $row['course_year']; ?></td>
                            <td><?php echo $row['reason']; ?></td>
                            <td><?php echo $row['status'] ?: 'Not Yet Received'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">No referrals found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if (isset($referral)): ?>
    <!-- Referral Details -->
    <div class="mt-4">
        <h4>Referral Details</h4>
        <p><strong>Student Name:</strong> <?= htmlspecialchars($referral['student_name'] ?? '') ?></p>
        <p><strong>Course & Year:</strong> <?= htmlspecialchars($referral['course_year'] ?? '') ?></p>
        <p><strong>Reason:</strong> <?= htmlspecialchars($referral['reason'] ?? '') ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($referral['status'] ?? 'Not Yet Received') ?></p>
    </div>
<?php endif; ?>

    </div>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
