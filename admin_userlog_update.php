<?php
include('connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted form data
    $AccountId = $_POST['AccountId'];
    $name = $_POST['name'];
    $year = $_POST['year'];
    $course = $_POST['course'];
    $section = $_POST['section'];

    // Log the received data to a file for debugging
    error_log("Received data: AccountId = $AccountId, Name = $name, Year = $year, Course = $course, Section = $section");

    // Prepare the update statement
    $stmt = $connect->prepare("UPDATE `bcp_sms3_user` SET `name`=?, `year`=?, `course`=?, `section`=? WHERE AccountId = ?");
    if (!$stmt) {
        error_log("Prepared statement failed: " . $connect->error); // Log any errors with the prepare statement
    }

    $stmt->bind_param("ssssi", $name, $year, $course, $section, $AccountId);

    if ($stmt->execute()) {
        echo "User updated successfully.";
    } else {
        echo "Error updating user: " . $stmt->error;
    }
    $stmt->close();
}
?>
