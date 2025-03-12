<?php
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['AccountId'])) {
    $AccountId = $_POST['AccountId'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Debugging line to check data
    error_log("Updating AccountId: $AccountId, Name: $name, Password: $password");

    // SQL query to update admin data
    $updateQuery = "UPDATE bcp_sms3_admin SET name = ?, password = ? WHERE AccountId = ?";

    // Prepare the statement
    if ($stmt = $connect->prepare($updateQuery)) {
        // Bind parameters
        $stmt->bind_param("ssi", $name, $password, $AccountId);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Admin log updated successfully."; 
        } else {
            echo "Error updating admin log: " . $stmt->error; 
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $connect->error; 
    }
} else {
    echo "Invalid request."; 
}

$connect->close();
?>