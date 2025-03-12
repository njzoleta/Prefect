<?php
include('connect.php');  // Include database connection

// Check if the connection was successful
if ($connect->connect_error) {
    die('Connection Error: ' . $connect->connect_error);
}

// Query to get data from the bcp_sms3_admin table
$query = "SELECT * FROM bcp_sms3_admin"; // Ensure this query is correct and matches your database schema

// Prepare the query
$stmt = $connect->prepare($query);

// Error handling for the prepare statement
if (!$stmt) {
    die('MySQL Error: ' . $connect->error);
}

// Execute the statement
$stmt->execute();

// Get the result
$res = $stmt->get_result();

// Check if the query returned any rows
if ($res === false) {
    die('Query Execution Failed: ' . $stmt->error);
}

// Check if we have any rows in the result set
if ($res->num_rows > 0) {
    $cnt = 1;
    // Loop through the result set and display data
    while ($row = $res->fetch_object()) {
        echo "<tr>
                <td>{$cnt++}</td>
                <td>{$row->AccountId}</td>
                <td>{$row->name}</td>
                <td>{$row->password}</td>
                <td>
                    <button class='btn btn-warning btn-sm editBtn' data-bs-toggle='modal' data-bs-target='#editModal'
                        data-AccountId='{$row->AccountId}' data-name='{$row->name}' 
                        data-password='{$row->password}'>
                        Edit
                    </button>
                    <button class='btn btn-danger btn-sm deleteBtn' data-bs-toggle='modal' data-bs-target='#deleteModal'
                        data-AccountId='{$row->AccountId}'>
                        Delete
                    </button>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No records found.</td></tr>";
}

// Close the statement and connection
$stmt->close();
$connect->close();
?>
