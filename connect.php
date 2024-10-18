<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "bcp_sms3_prefect"; 


$connect = new mysqli($servername, $username, $password, $dbname);


if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>