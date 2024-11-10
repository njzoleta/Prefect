<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "pref_bcp_sms3"; 


$connect = new mysqli($servername, $username, $password, $dbname);
$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
