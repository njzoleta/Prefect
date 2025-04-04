<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the referral form
    $student_number = $_POST['student_number']; // Ensure this field is in your form
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
        echo "Error submitting referral: " . $stmt->error; // Output specific error from the SQL query
    }

    // Close the statement
    $stmt->close();
    $conn->close();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Referral Slip</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/case.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <!-- ======= Header ======= -->
    <?php include('C:\xampp\htdocs\Prefect\inc\header.php'); ?>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php include('C:\xampp\htdocs\Prefect\inc\adminsidebar.php'); ?>
    <!-- End Sidebar-->


    <div class="container mt-5 p-4 border rounded">
        <div class="text-center mb-4">
            <img src="logo.png" alt="Logo" class="mb-3" style="width: 100px;">
            <h5>BESTLINK COLLEGE OF THE PHILIPPINES</h5>
            <p>762 Topaz cor. Sapphire St., Millionaires Village, Novaliches, Quezon City</p>
            <h6 class="text-decoration-underline">OFFICE OF THE PREFECT OF DISCIPLINE</h6>
            <h6 class="text-danger">REFERRAL SLIP</h6>
        </div>

        <!-- Referral Form -->
        <form action="guidance.php" method="POST" id="referralForm">
            <div class="mb-3">
                <label>Student Number:</label>
                <input type="text" name="student_number" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Student’s Name:</label>
                <input type="text" name="student_name" class="form-control" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Course & Year:</label>
                    <input type="text" name="course_year" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label>Age:</label>
                    <input type="number" name="age" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label>Sex:</label>
                    <select name="sex" class="form-select" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label>Reason for Referral:</label>
                <textarea name="reason" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label>Referred To:</label>
                <input type="text" name="referred_to" value="Ms. Vicky Marie Montoya" class="form-control" readonly>
            </div>
            <div class="mb-3">
                <label>Referred By:</label>
                <input type="text" name="referred_by" value="Benildo R. Concepcion" class="form-control" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Submit Referral</button>
        </form>

        <!-- Confirmation Message -->
        <div id="confirmationMessage" class="alert alert-success mt-4" style="display: none;">
            Referral submitted successfully! Thank you for submitting the referral. You may now provide feedback.
        </div>
    </div>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
$(document).ready(function () {
    $('#referralForm').submit(function (event) {
        event.preventDefault(); // Prevent default form submission

        var formData = $(this).serialize(); // Serialize form data for AJAX submission

        $.ajax({
            type: "POST",
            url: "guidance.php", // The PHP file that processes the form
            data: formData, // Send the serialized form data
            success: function(response) {
                console.log(response); // Log the entire response for debugging
                if (response.includes("Referral submitted successfully!")) {
                    $("#confirmationMessage").show(); // Show the confirmation message
                    $("#referralForm")[0].reset(); // Reset the form

                    // After submitting the form, ask for feedback:
                    showFeedbackForm();
                } else {
                    alert("There was an error submitting the referral.");
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert("There was an error with the request.");
            }
        });
    });
});

// Function to show the feedback form after submission
function showFeedbackForm() {
    // Assuming you have a feedback section hidden initially
    $('#feedbackSection').show(); // Unhide the feedback section after form submission
}
</script>
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
