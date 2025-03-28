<?php
// Database configuration
$servername = getenv('DB_SERVER') ?: 'localhost'; 
$AccountId = getenv('DB_ACCOUNT_ID') ?: 'root'; 
$password = getenv('DB_PASSWORD') ?: ''; 
$dbname = getenv('DB_NAME') ?: 'pref_bcp_sms3'; 


$connect = new mysqli($servername, $AccountId, $password, $dbname);

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>

<?php
// Database configuration
$servername = getenv('DB_SERVER') ?: 'localhost'; 
$username = getenv('DB_ACCOUNT_ID') ?: 'root'; 
$password = getenv('DB_PASSWORD') ?: ''; 
$dbname = getenv('DB_NAME') ?: 'pref_bcp_sms3'; 

// Use $conn instead of $connect
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
