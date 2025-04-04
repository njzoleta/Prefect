<?php
include('connect.php');

if (isset($_GET['query']) && isset($_GET['category'])) {
    $search = trim($_GET['query']);
    $category = trim($_GET['category']); // College or Senior High
    $search = "%$search%"; // Para kahit partial match, makuha

    // Query na may category filter
    $query = "SELECT first_name, last_name, year, course, section, adviser 
              FROM bcp_sms3_student 
              WHERE category = ? 
              AND CONCAT(first_name, ' ', last_name) LIKE ? 
              LIMIT 10"; // Limit para di mabigat

    $stmt = $connect->prepare($query);
    $stmt->bind_param("ss", $category, $search); // Bind both category and search
    $stmt->execute();
    $result = $stmt->get_result();

    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }

    if (count($students) > 0) {
        echo json_encode($students); // Return students data
    } else {
        echo json_encode(["error" => "No student found", "search" => $search]);
    }
}
?>
