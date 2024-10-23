<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "pref_bcp_sms3";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Account_Id']) && isset($_POST['Password'])) {

        $Account_Id = $conn->real_escape_string($_POST['Account_Id']);
        $Password = $conn->real_escape_string($_POST['Password']);

 
        $stmt = $conn->prepare("SELECT * FROM bcp_sms3_register WHERE Account_Id = ? AND Password = ? AND User_type = 1");
        $stmt->bind_param('ss', $Account_Id, $Password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['Account_Id'] = $Account_Id;
            $_SESSION['User_Type'] = '1'; 
            header("Location: admin.php"); 
            exit();
        }

    
        $stmt = $conn->prepare("SELECT * FROM bcp_sms3_register WHERE Account_Id = ? AND Password = ? AND User_type = 2");
        $stmt->bind_param('ss', $Account_Id, $Password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['Account_Id'] = $Account_Id;
            $_SESSION['User_Type'] = '2'; 
            header("Location: user.php"); 
            exit();
        }

   
        $error = "Invalid Account ID or Password.";
    } else {
        $error = "Please enter both Account ID and Password.";
    }
}

$conn->close();
?>


<?php if (!empty($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Prefect Management System.">
    <link href="assets/css/login.css" rel="stylesheet">

    <title>Login - Prefect</title>
</head>

<body>
    <div class="logo">
        <img src="logo.png" alt="Logo">
        <p>Prefect Management System</p> 
    </div>
    
    <div class="login-container">
        <h2>Log Into Your Account</h2>
 
                <div class="error-message" style="color: red;">
                    <?= $error ?>

        <form id="loginForm" action="" method="post">
            <label for="Account_Id">Account ID</label>
            <input type="number" id="Account_Id" name="Account_Id" required aria-label="Account_ID">

            <label for="Password">Password</label>
            <input type="Password" id="Password" name="Password" required aria-label="Password">

            <button type="submit">LOGIN</button>
        </form>
    </div>
</body>
</html>