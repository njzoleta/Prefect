<?php
include('connect.php');  // Include database connection

// Check if the connection was successful
if ($connect->connect_error) {
    die('Connection Error: ' . $connect->connect_error);
}

// Query to get data
$query = "SELECT * FROM bcp_sms3_user";
$stmt = $connect->prepare($query);

// Error handling for the prepare statement
if (!$stmt) {
    die('MySQL Error: ' . $connect->error);
}

$stmt->execute();
$res = $stmt->get_result();

// Error handling for getting result
if ($res === false) {
    die('Query Execution Failed: ' . $stmt->error);
}

$cnt = 1;
if ($res->num_rows > 0) {
    while ($row = $res->fetch_object()) {
        echo "<tr>
                <td>{$cnt}</td>
                <td>{$row->AccountId}</td>
                <td>{$row->name}</td>
                <td>{$row->year}</td>
                <td>{$row->course}</td>
                <td>{$row->section}</td>
                <td>
                    <button class='btn btn-warning btn-sm editBtn' data-bs-toggle='modal' data-bs-target='#editModal'
                        data-AccountId='{$row->AccountId}' data-name='{$row->name}' 
                        data-year='{$row->year}' data-course='{$row->course}' 
                        data-section='{$row->section}'>
                        Edit
                    </button>
                    <button class='btn btn-danger btn-sm deleteBtn' data-bs-toggle='modal' data-bs-target='#deleteModal'
                        data-AccountId='{$row->AccountId}'>
                        Delete
                    </button>
                </td>
            </tr>";
        $cnt++; // Increment the counter here
    }
} else {
    echo "<tr><td colspan='12'>No records found.</td></tr>";
}

// Close the statement and connection
$stmt->close();
$connect->close();
?>