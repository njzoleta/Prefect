<?php
include('connect.php'); // Siguraduhin na tama ang database connection

header('Content-Type: application/json'); // Set JSON response

// Check kung may `severity` na pinasa sa request
if (!isset($_GET['severity'])) {
    echo json_encode(["error" => "No severity provided"]);
    exit;
}

$severity = $_GET['severity']; // Kunin ang severity na pinasa

// Piliin ang tamang table batay sa severity
$table = "";
$code_column = "";
$desc_column = "";

if ($severity === "Minor") {
    $table = "bcp_sms3_minor";
    $code_column = "minorcode";
    $desc_column = "minor";
} elseif ($severity === "Major") {
    $table = "bcp_sms3_major";
    $code_column = "majorcode";
    $desc_column = "major";
} elseif ($severity === "Grave") {
    $table = "bcp_sms3_grave";
    $code_column = "gravecode";
    $desc_column = "grave";
} else {
    echo json_encode(["error" => "Invalid severity"]);
    exit;
}

// Query para kunin ang data
$query = "SELECT $code_column AS code, $desc_column AS description FROM $table";
$result = $connect->query($query);

if (!$result) {
    echo json_encode(["error" => "Database query failed: " . $connect->error]);
    exit;
}

$offences = [];
while ($row = $result->fetch_assoc()) {
    $offences[] = $row;
}

echo json_encode($offences);
?>
