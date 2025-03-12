<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('connect.php');
    
    // Retrieve the form data
    $Studentnumber_Id = $_POST['Studentnumber_Id'];
    $NameId = $_POST['Nameid'];
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
              WHERE Studentnumber_Id = ?";
    
    // Prepare the statement
    $stmt = $connect->prepare($query);
    if ($stmt === false) {
        die('MySQL Error: ' . $connect->error);
    }

    // Bind the parameters
    $stmt->bind_param('sssssssssi', $NameId , $yearid, $courseid, $sectionid, $severityid, $offencesid, $involve, $penalties, $Status, $Studentnumber_Id);

    // Execute the query
    if ($stmt->execute()) {
        echo "Incident updated successfully.";
    } else {
        echo "Error updating incident: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $connect->close();
}
?>
