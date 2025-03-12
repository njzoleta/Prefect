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