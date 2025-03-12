<?php
include('connect.php');  // Include database connection

// Check if the connection was successful
if ($connect->connect_error) {
    die('Connection Error: ' . $connect->connect_error);
}

// Query to get data
$query = "SELECT * FROM bcp_sms_log";
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
                <td>{$row->Studentnumber_Id}</td>
                <td>{$row->Nameid}</td>
                <td>{$row->yearid}</td>
                <td>{$row->courseid}</td>
                <td>{$row->sectionid}</td>
                <td>{$row->severityid}</td>
                <td>{$row->offencesid}</td>
                <td>{$row->involve}</td>
                <td>{$row->penalties}</td>
                <td><span class='badge badge-success'>{$row->Status}</span></td>
                <td>
                    <button class='btn btn-warning btn-sm editBtn' data-bs-toggle='modal' data-bs-target='#editModal'
                        data-Studentnumber_Id='{$row->Studentnumber_Id}' data-Nameid='{$row->Nameid}' 
                        data-yearid='{$row->yearid}' data-courseid='{$row->courseid}' 
                        data-sectionid='{$row->sectionid}' data-severityid='{$row->severityid}'
                        data-offencesid='{$row->offencesid}' data-involve='{$row->involve}' 
                        data-penalties='{$row->penalties}' data-status='{$row->Status}'>
                        Edit
                    </button>
                    <button class='btn btn-danger btn-sm deleteBtn' data-bs-toggle='modal' data-bs-target='#deleteModal'
                        data-Studentnumber_Id='{$row->Studentnumber_Id}'>
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