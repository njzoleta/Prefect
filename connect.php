<?php
// Database configuration
$servername = getenv('DB_SERVER') ?: 'localhost'; 
$Username = getenv('DB_USERNAME') ?: 'root'; 
$password = getenv('DB_PASSWORD') ?: ''; 
$dbname = getenv('DB_NAME') ?: 'pref_bcp_sms3'; 


$connect = new mysqli($servername, $Username, $password, $dbname);

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>

<?php
// Database configuration
$servername = getenv('DB_SERVER') ?: 'localhost'; 
$Username = getenv('DB_Username') ?: 'root'; 
$password = getenv('DB_PASSWORD') ?: ''; 
$dbname = getenv('DB_NAME') ?: 'pref_bcp_sms3'; 

// Use $conn instead of $connect
$conn = new mysqli($servername, $Username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>



