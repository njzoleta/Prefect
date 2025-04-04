<?php
session_start();
include('connect.php');

if (isset($_POST['Case_id'])) {
    $Case_id = $_POST['Case_id'];

    // Retrieve accuser's details from `bcp_sms3_case`
    $query = "SELECT * FROM bcp_sms3_case WHERE Case_id = ?";
    $stmt = $connect->prepare($query);
    
    if (!$stmt) {
        die("Error preparing query: " . $connect->error);
    }

    $stmt->bind_param("i", $Case_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Insert data into `incident_log`
        $insertQuery = "INSERT INTO incident_log (Name_accuser, Section_accuser, Course_accuser, Year_accuser, Adviser_accuser, Type_incident, Incident_place, Time_incident) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmtInsert = $connect->prepare($insertQuery);

        if (!$stmtInsert) {
            die("Error preparing insert query: " . $connect->error);
        }

        $stmtInsert->bind_param("ssssssss", 
            $row['Name_accuser'], 
            $row['Section_accuser'], 
            $row['Course_accuser'], 
            $row['Year_accuser'], 
            $row['Adviser_accuser'], 
            $row['Type_incident'], 
            $row['Incident_place'], 
            $row['Time_incident']
        );

        if ($stmtInsert->execute()) {
            echo "Successfully transferred to Incident Log!";
        } else {
            echo "Error transferring data: " . $stmtInsert->error;
        }

        $stmtInsert->close();
    } else {
        echo "Case not found.";
    }

    $stmt->close();
} else {
    echo "Case ID not provided.";
}
?>
