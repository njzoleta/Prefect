<?php
include('connect.php');

header('Content-Type: application/json');

// Check and validate severity
if (!isset($_GET['severity'])) {
    echo json_encode(["error" => "No severity provided"]);
    exit;
}

$severity = $_GET['severity'];
$valid_severities = ["Minor", "Major", "Grave"];
if (!in_array($severity, $valid_severities)) {
    echo json_encode(["error" => "Invalid severity"]);
    exit;
}

// Map table and column names based on severity
$table_map = [
    "Minor" => ["table" => "bcp_sms3_minor", "code" => "minorcode", "desc" => "minor"],
    "Major" => ["table" => "bcp_sms3_major", "code" => "majorcode", "desc" => "major"],
    "Grave" => ["table" => "bcp_sms3_grave", "code" => "gravecode", "desc" => "grave"]
];

$table_info = $table_map[$severity];
$table = $table_info['table'];
$code_col = $table_info['code'];
$desc_col = $table_info['desc'];

// Compose raw query (safe because table/columns are from validated mapping)
$query = "SELECT $code_col AS code, $desc_col AS description FROM $table";

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
