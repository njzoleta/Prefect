<?php
include('connect.php'); // Siguraduhin na tama ang database connection

if (isset($_GET['name'])) {
    $name = trim($_GET['name']); // Alisin ang extra spaces
    $nameParts = explode(" ", $name, 2); // Hatiin sa First Name at Last Name

    if (count($nameParts) == 2) {
        $firstName = trim($nameParts[0]); 
        $lastName = trim($nameParts[1]); 

        // Query para maging case-insensitive at iwas extra spaces
        $query = "SELECT year, course, section FROM bcp_sms3_student 
                  WHERE LOWER(TRIM(first_name)) = LOWER(?) 
                  AND LOWER(TRIM(last_name)) = LOWER(?)";
                  
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ss", $firstName, $lastName);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            echo json_encode($row); // Ibalik ang data bilang JSON
        } else {
            echo json_encode(["error" => "No data found"]);
        }
    } else {
        echo json_encode(["error" => "Invalid name format"]);
    }
}
?>
