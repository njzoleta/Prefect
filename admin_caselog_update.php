<?php
session_start();
include('connect.php'); // Siguraduhin na ito ay tamang path sa database connection mo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Studentnumber_id = $_POST['Studentnumber_id'];
    $Nameid = $_POST['Nameid'];
    $yearid = $_POST['yearid'];
    $courseid = $_POST['courseid'];
    $sectionid = $_POST['sectionid'];
    $severityid = $_POST['severityid'];
    $offencesid = $_POST['offencesid'];
    $involve = $_POST['involve'];
    $penalties = $_POST['penalties'];
    $Status = $_POST['Status'];

    // Update query
    $query = "UPDATE bcp_sms_log SET 
                Nameid = ?, 
                yearid = ?, 
                courseid = ?, 
                sectionid = ?,
                severityid = ?, 
                offencesid = ?, 
                involve = ?, 
                penalties = ?, 
                Status = ? 
              WHERE Studentnumber_id = ?";

    $stmt = $connect->prepare($query);
    if ($stmt === false) {
        die('MySQL Error: ' . $connect->error);
    }

    $stmt->bind_param('sssssssssi', $Nameid, $yearid, $courseid,$sectionid ,$severityid, $offencesid, $involve, $penalties, $Status, $Studentnumber_id);

    if ($stmt->execute()) {
        echo "Incident updated successfully.";
    } else {
        echo "Error updating incident: " . $stmt->error;
    }

    $stmt->close();
    $connect->close();
}
?>
