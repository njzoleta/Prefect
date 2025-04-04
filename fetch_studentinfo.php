<?php
include('connect.php'); // Ensure this file establishes a connection to your database

if (isset($_GET['student_number'])) {
    $studentNumber = trim($_GET['student_number']);

    $query = "SELECT student_number, first_name, last_name, year, course, section, adviser, guardian_name, guardian_contact 
              FROM bcp_sms3_student 
              WHERE student_number = ? 
              LIMIT 1";

    $stmt = $connect->prepare($query);
    $stmt->bind_param("s", $studentNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        header('Content-Type: application/json');
        echo json_encode($row); // Ensure only one student is returned
    } else {
        echo json_encode(["error" => "No student found"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid request"]);
}
?>
