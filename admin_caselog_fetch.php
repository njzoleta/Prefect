<?php
include('connect.php'); // Siguraduhin na tama ang path

$query = "SELECT * FROM bcp_sms_log";
$res = $connect->query($query);

if (!$res) {
    die("Query failed: " . $connect->error);
}

$cnt = 1; // Initialize counter

if ($res->num_rows > 0) {
    while ($row = $res->fetch_object()) {
        ?>
        <tr>
            <td><?php echo $cnt++; ?></td>
            <td><?php echo htmlspecialchars($row->Studentnumber_id); ?></td>
            <td><?php echo htmlspecialchars($row->Nameid); ?></td>
            <td><?php echo htmlspecialchars($row->yearid); ?></td>
            <td><?php echo htmlspecialchars($row->courseid); ?></td>    
            <td><?php echo htmlspecialchars($row->sectionid); ?></td>
            <td><?php echo htmlspecialchars($row->offencesid); ?></td>
            <td><?php echo htmlspecialchars($row->involve); ?></td>
            <td><?php echo htmlspecialchars($row->severityid); ?></td>
            <td><?php echo htmlspecialchars($row->penalties); ?></td>
            <td><?php echo htmlspecialchars($row->date_created); ?></td>
            <td>
                <?php
                $status = htmlspecialchars($row->Status);
                if ($status == 'Active') {
                    echo "<span class='badge bg-danger'>$status</span>";
                } elseif ($status == 'Resolved') {
                    echo "<span class='badge bg-success'>$status</span>";
                } elseif ($status == 'Pending') {
                    echo "<span class='badge bg-warning'>$status</span>";
                }
                ?>
            </td>
            <td>
                <button class='btn btn-info btn-sm viewBtn' data-bs-toggle='modal' data-bs-target='#viewDetailsModal'
                    data-Studentnumber_id='<?php echo htmlspecialchars($row->Studentnumber_id); ?>'
                    data-Nameid='<?php echo htmlspecialchars($row->Nameid); ?>'
                    data-yearid='<?php echo htmlspecialchars($row->yearid); ?>' 
                    data-courseid='<?php echo htmlspecialchars($row->courseid); ?>'
                    data-sectionid='<?php echo htmlspecialchars($row->sectionid); ?>'
                    data-date_created='<?php echo htmlspecialchars($row->date_created); ?>'   
                    data-severityid='<?php echo htmlspecialchars($row->severityid); ?>'
                    data-offencesid='<?php echo htmlspecialchars($row->offencesid); ?>'
                    data-involve='<?php echo htmlspecialchars($row->involve); ?>'
                    data-penalties='<?php echo htmlspecialchars($row->penalties); ?>'
                    data-Status='<?php echo htmlspecialchars($row->Status); ?>'>
                    View Details
                </button>
                <button class='btn btn-warning btn-sm editBtn' data-bs-toggle='modal' data-bs-target='#editModal'
                    data-Studentnumber_id='<?php echo htmlspecialchars($row->Studentnumber_id); ?>'
                    data-Nameid='<?php echo htmlspecialchars($row->Nameid); ?>'
                    data-yearid='<?php echo htmlspecialchars($row->yearid); ?>' 
                    data-courseid='<?php echo htmlspecialchars($row->courseid); ?>'
                    data-sectionid='<?php echo htmlspecialchars($row->sectionid); ?>'
                    data-date_created='<?php echo htmlspecialchars($row->date_created); ?>'
                    data-severityid='<?php echo htmlspecialchars($row->severityid); ?>'
                    data-offencesid='<?php echo htmlspecialchars($row->offencesid); ?>'
                    data-involve='<?php echo htmlspecialchars($row->involve); ?>'
                    data-penalties='<?php echo htmlspecialchars($row->penalties); ?>'
                    data-Status='<?php echo htmlspecialchars($row->Status); ?>'>
                    Edit
                </button>
            </td>
        </tr>
        <?php
    }
} else {
    echo "<tr><td colspan='10'>No records found.</td></tr>";
}

$connect->close();
?>
