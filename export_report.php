<?php
session_start();
include('connect.php'); // Ensure this connects to your database

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=incident_report.csv");
header("Pragma: no-cache");
header("Expires: 0");

$output = fopen('php://output', 'w'); // Open output stream

// Output column headers (without "Description")
fputcsv($output, ["Incident ID", "Category", "Course ID", "Severity", "Date"]);

// Fetch all data from the database
$sql = "SELECT Studentnumber_id, category, courseid, severityid, incident_date FROM bcp_sms_log ORDER BY incident_date DESC";
$result = $connect->query($sql);

while ($row = $result->fetch_assoc()) {
    // Output data without the "Description" column
    fputcsv($output, [
        $row['Studentnumber_id'], 
        $row['category'], 
        $row['courseid'], 
        $row['severityid'], 
        $row['incident_date']
    ]);
    
    ob_flush(); // Prevent memory overflow for large data
}

fclose($output);
exit;
?>
